<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Osms\Osms;

class SendSms extends Notification
{
    use Queueable;
    public $osms;
    public $receiverAddress;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($to, $message)
    {
        $this->receiverAddress = $to;
        $this->message = $message;
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
        } else if(empty($response['access_token'])) {
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

    public function toSms($notifiable)
    {
        $senderAddress = config('orange.from');
        $senderName = config('app.name');
        $response = $this->osms->sendSMS($senderAddress, $this->receiverAddress, $this->message, $senderName);
        if (array_key_exists('error', $response)) {
            notify()->error($response['error']);
        }
        return $response;
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
