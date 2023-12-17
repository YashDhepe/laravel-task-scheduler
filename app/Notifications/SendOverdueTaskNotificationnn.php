<?php

// app/Notifications/OverdueTaskNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class SendOverdueTaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
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

    public function toMail($notifiable)
    {
        $url = $this->generateUrl();

        return (new MailMessage)
            ->subject('Overdue Task Notification')
            ->line('The task "' . $this->task->name . '" is overdue.')
            ->action('View Task', $url)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
        ];
    }

    protected function generateUrl()
    {
        return URL::signedRoute('tasks.assign.view-tasks', ['taskId' => encrypt($this->task->id)]);
    }
}
