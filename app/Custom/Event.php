<?php

namespace App\Custom;

use App\Models\User;
use App\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class Event
{
    public static function dispatch($channel, $event, $data)
    {
        $options = array(
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            config("broadcasting.connections.pusher.key"),
            config("broadcasting.connections.pusher.secret"),
            config('broadcasting.connections.pusher.app_id'),
            $options
        );
        $pusher->trigger($channel, $event, $data);
    }

    public static function dispatchGeneralEvent($data) {
        Event::dispatch('general','general-event',$data);
    }

    public static function dispatchUserEvent($data,User $user) {
        Event::dispatch('user-'.$user->id,'user-event',$data);
        Notification::send($user,new DatabaseNotification($data));
    }

    public static function Message($title, $message) {
        return ['title'=>$title,'message'=>$message];
    }
};
