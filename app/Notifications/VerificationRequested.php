
<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Shops;

class VerificationRequested extends Notification
{
    use Queueable;

    public $shop;

    public function __construct(Shops $shop)
    {
        $this->shop = $shop;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new verification request has been submitted for the shop: ' . $this->shop->name)
                    ->action('View Shop', url('/admin/shops/' . $this->shop->id))
                    ->line('Thank you for using our application!');
    }
}