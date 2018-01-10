<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use DateTime;

class CourseNotification extends Notification
{
    use Queueable;
    private $event;
    private $sender;
    /**
     * ask : demande de cours
     * reply : réponse d'une demande
     * @var [type]
     */
    private $type;

    /**
     * Si c'est une réponse :
     * 0 : réponse refusée
     * 1 : réponse acceptée
     * @var [type]
     */
    private $response;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event, $sender, $type, $response = null)
    {
        $this->event = $event;
        $this->sender = $sender;
        $this->type = $type;
        $this->response = $response;
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
        //$date = new \DateTime($this->event->start_date->format('d/m/Y'));
        if ($this->type == 'reply') {
            switch ($this->response) {
                //Refusée
                case 0:
                    return [
                        'message' => $this->sender->prenom . ' ' . $this->sender->nom . ' a refusé votre cours du ' . utf8_encode($this->event->start_date),
                        'action' => 0,
                        'type' => $this->type,
                    ];
                    break;
                //Acceptée
                default:
                     return [
                        'message' => $this->sender->prenom . ' ' . $this->sender->nom . ' a accepté votre cours du ' . utf8_encode($this->event->start_date) . '.',
                        'action' => 1,
                        'type' => $this->type,
                    ];
                    break;
            }
        }
        else
        {
            // $type = ask            
            return [
                'message' => $this->sender->prenom . ' ' . $this->sender->nom . ' vous propose de faire un cours ' . utf8_encode($this->event->start_date->format('\\l\\e d/m/Y \\&\\a\\g\\r\\a\\v\\e\\;  G\\hi')),
                'events_id' => $this->event->id,
                'senders_id' => $this->sender->id,
                'type' => $this->type,
            ];
        }
       
    }
}
