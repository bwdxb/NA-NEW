<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendProductApprovalMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $product_status;
    public $user;
    public $reason;
    public function __construct($user,$product_status,$reason)
    {
       $this->user = $user;
       $this->product_status = $product_status;
       $this->reason = $reason;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;
        $message->line('Dear '.$this->user->first_name.' '.$this->user->last_name);
        $message->line('Product Approval Notification.');
        if($this->product_status ==1){
            $status  = 'Approved';
        }elseif($this->product_status ==2){
            $status  = 'Reject';
        }
        $message->line('Your Product Status is '.$status);
        $message->line('Reason:'.$this->reason);
        return $message;
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
