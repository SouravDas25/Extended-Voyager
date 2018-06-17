<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/16/2018
 * Time: 10:37 PM
 */

namespace TCG\Voyager\Notifications;


use Illuminate\Notifications\Notification;

class VoyagerNotification extends Notification
{

    /*
     * the notification table consists the following attribute
     * - id
     * - type (namespace of the notification)
     * - notifiable type (namespace of the class which is notified)
     * - notifiable id ( id of the model with is notified)
     * - data
     * - read_at
     */

    /**
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * overwite this method what ever to return from this function
     * you get from the data attribute
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

        ];
    }
}