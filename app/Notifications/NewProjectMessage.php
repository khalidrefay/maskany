<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProjectMessage;

class NewProjectMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct(ProjectMessage $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('رسالة جديدة على مشروعك')
            ->greeting('مرحباً ' . $notifiable->name)
            ->line('لقد تلقيت رسالة جديدة من المستشار ' . $this->message->consultant->name)
            ->line('المشروع: ' . $this->message->project->title)
            ->line('الرسالة: ' . $this->message->message)
            ->action('عرض الرسالة', url('/projects/' . $this->message->project_id . '/messages'))
            ->line('شكراً لاستخدامك منصتنا');
    }

    public function toArray($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'project_id' => $this->message->project_id,
            'consultant_id' => $this->message->consultant_id,
            'consultant_name' => $this->message->consultant->name,
            'project_title' => $this->message->project->title,
        ];
    }
}
