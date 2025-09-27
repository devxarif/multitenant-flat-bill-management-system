<?php

namespace App\Notifications;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BillCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $bill;

    /**
     * Create a new notification instance.
     */
    public function __construct(Bill $bill)
    {
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
        return (new MailMessage)
            ->subject('New Bill Created: '.$this->bill->month->format('F Y'))
            ->line("Flat: {$this->bill?->flat->flat_number} | Category: {$this->bill?->category->name}")
            ->line("Amount: {$this->bill?->amount} | Carried Due: {$this->bill?->carried_due} | Total: {$this->bill?->total_due}")
            ->action('View Bill', url(route('owner.bills.show',$this->bill?->id)))
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
