<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BillPaidNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $bill;

    /**
     * Create a new notification instance.
     */
    public function __construct($bill){
        $this->bill = $bill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $paid = $this->bill->payments()->sum('amount');

        return (new MailMessage)
            ->subject('Bill Payment Received: '.$this->bill?->month->format('F Y'))
            ->line("Flat: {$this->bill?->flat?->flat_number}")
            ->line("Paid: {$paid} | Total: {$this->bill?->total_due}")
            ->action('View Bill', url(route('owner.bills.show',$this->bill->id)))
            ->line('Thank you.');
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
