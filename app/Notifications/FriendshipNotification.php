<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendshipNotification extends Notification
{
    use Queueable;


    /**
     * Utilisateur qui à fais l'action sur la demande.
     * @var Friendship
     */
    private $type;

    private $username;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $username)
    {
        $this->type = $type;
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // 1 : acceptée
        // 2 : refusée
        // 3 : bloquée
        switch ($this->type) {
            case 1:
                return [
                    'message' => $this->username.utf8_decode(' a accept&eacute; votre demande!'),
                    'type' => $this->type,
                ];
                break;
            case 2:
                return [
                    'message' => $this->username.utf8_decode(' a refus&eacute; votre demande!'),
                    'type' => $this->type,
                ];
                break;
            default:
                return [
                    'message' => $this->username.utf8_decode(' a refus&eacute; votre demande!'),
                    'type' => $this->type,
                ];
                break;
        }
    }
}
