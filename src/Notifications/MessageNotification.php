<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/16/2018
 * Time: 2:35 PM
 */

namespace TCG\Voyager\Notifications;

class MessageNotification extends VoyagerNotification
{
    private $msg;
    private $link;

    /**
     * @param $msg
     * @param $link
     */
    public function __construct($msg,$link = "#")
    {
        $this->msg = $msg;
        $this->link = $link;
    }

    public function toArray($notifiable)
    {
        return [
            'msg' => $this->msg,
            'link' => $this->link,
            'user'=>$notifiable
        ];
    }
}