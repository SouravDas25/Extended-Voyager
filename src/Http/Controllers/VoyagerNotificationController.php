<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/17/2018
 * Time: 12:28 AM
 */

namespace TCG\Voyager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class VoyagerNotificationController
{
    public function all()
    {
        return view('voyager::notifications.all');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectAfterRead(Request $request, $id)
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        $link = $notification->data['link'];
        return ($link !== '#') ? Redirect::away($notification->data['link']) : Redirect::back();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return Redirect::back();
    }

    /*public function apiAll(Request $request)
    {
        $data = Auth::user()->notifications()->simplePaginate()->toArray();
        //dd($data);
        for($i = 0 ; $i < count($data) ;$i++){
            $notification = $data['data'][$i];
            $content = View::make("voyager::notifications.".snake_case(class_basename($notification['type'])) , compact('notification') );
            $contents = $content->render();
            $data['data'][$i] = $contents;
        }
        return $data;
    }*/


}