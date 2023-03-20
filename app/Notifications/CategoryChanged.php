<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class CategoryChanged extends Notification
{
    use Queueable;

    private $changedBy;
    private $user;
    private $category;
    private $action;

    public function viaQueues(): array
    {
        return [
            'mail' => 'mails',
        ];
    }

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $changedBy, $category, $action)
    {
        $this->user = $user;
        $this->changedBy = $changedBy;
        $this->category = $category;
        $this->action = $action;
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
            ->subject('Category ' . $this->action)
            ->greeting('Hello ' . $this->user->name)
            ->line('Category ' . $this->category->name . ' was ' . $this->action . ' by ' . $this->changedBy->name)
            ->action('View Category', route('categories.show', $this->category->id))
            ->line('Thank you for using our application!');
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
