<?php

namespace App\Custom;

use Pusher\Pusher;

class Event
{
    public static function dispatch($channel, $event, $data)
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
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

    public static function dispatchUserEvent($data,$userId) {
        Event::dispatch('user-'.$userId,'user-event',$data);
    }

    public static function Message($title, $message) {
        return ['title'=>$title,'message'=>$message];
    }
};
