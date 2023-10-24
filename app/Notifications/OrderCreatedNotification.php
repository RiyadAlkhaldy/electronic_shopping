<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct( public Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database','broadcast'];
        $channels = ['database'];
        if ($notifiable->notification_preference['order_created']['sms']  ) {
            $channels[] = 'sms';
         }
         if ($notifiable->notification_preference['order_created']['mail']  ) {
            $channels[] = 'mail';
         }
         if ($notifiable->notification_preference['order_created']['broadcast']  ) {
            $channels[] = 'broadcast';
         }
        return $channels;
}

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
                    ->subject("New Order # {$this->order->number} " )
                    ->from('notification@gmail.com','Reyad Alkhaldly')
                    ->line( " A new order # # {$this->order->number} created by {$addr->name} ")
                    ->greeting("Hi {$notifiable->name}")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable): array
    {
        $addr = $this->order->billingAddress;
        return  [
            'body' =>  " A new order # # {$this->order->number} created by {$addr->name} ",
            'icon' => "fas fas-file",
            'url' => url('/'),
        ];
    }
    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        return new BroadcastMessage( [
            'body' =>  " A new order # # {$this->order->number} created by {$addr->name} ",
            'icon' => "fas fas-file",
            'url' => url('/'),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
