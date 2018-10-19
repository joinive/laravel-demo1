<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\InvoicePaid as Mailable;
use App\User;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];

        return ['mail','database','sms'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

//        return (new MailMessage)->view(
//            'emails.demo', ['invoice' => 'asdf']
//        )->subject('justtest');

        return (new Mailable(User::find(1)))->to('siversonw@126.com')
            ->subject('test')->attach(storage_path('app/public/72f082025aafa40f8197e0cca764034f78f01949.jpg'));

        //        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');

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

    public function toDatabase($notifiable) {

        return [
            'name'=>'adsf',
            'pass' =>time()
        ];
    }

    public function toSms() {

    }
}
