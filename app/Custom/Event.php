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
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
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
