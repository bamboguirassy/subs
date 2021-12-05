<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Custom\Osms;
use App\Models\Parametrage;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class SendSms extends Notification
{
    use Queueable;
    public $osms;
    public $message;
    public $initiator;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(?User $user, $message)
    {
        $this->message = $message;
        $this->initiator = $user;
        $config = array(
            'clientId' => env('ORANGE_CLIENT_ID'),
            'clientSecret' => env('ORANGE_CLIENT_SECRET')
        );

        $this->osms = new Osms($config);
        $this->osms->setVerifyPeerSSL(config('orange.verify_ssl'));
        // retrieve an access token
        $response = $this->osms->getTokenFromConsumerKey();
        if (array_key_exists('error', $response)) {
            notify()->error($response['error']);
        } else if (empty($response['access_token'])) {
            notify()->error("Aucun token pour l'envoi de SMS n'a été trouvé...");
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * SI l'initiateur est défini, le SMS n'est envoyé que lorsque son solde SMS est solvable
     * Si l'initiateur n'est pas défini, les SMS sont considérés comme publics
     */
    public function toSms($notifiable)
    {
        $senderAddress = config('orange.from');
        $senderName = config('app.name');
        $mailSent = false;
        if ($this->initiator != null) {
            if ($this->initiator->soldeSms > 0) {
                $response = $this->osms->sendSMS($senderAddress, 'tel:' . $notifiable->telephone, $this->message, $senderName);
                $mailSent = true;
            } else {
                notify()->error("Le solde SMS de l'initiateur est insuffisant, SMS non envoyé.");
            }
        } else {
            $response = $this->osms->sendSMS($senderAddress, 'tel:' . $notifiable->telephone, $this->message, $senderName);
            $mailSent = true;
        }
        if ($mailSent) {
            if (array_key_exists('error', $response)) {
                notify()->error($response['error']);
            } else {
                DB::beginTransaction();
                try {
                    $parametrage = Parametrage::getInstance();
                    $parametrage->soldeSms = $parametrage->soldeSms - 1;
                    $parametrage->update();
                    if ($this->initiator) {
                        $this->initiator->soldeSms = $this->initiator->soldeSms - 1;
                        $this->initiator->update();
                    }
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }
        }
        return null;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
