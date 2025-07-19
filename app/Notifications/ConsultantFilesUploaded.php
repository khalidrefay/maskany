<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProjectProposal;

class ConsultantFilesUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $proposal;

    public function __construct(ProjectProposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('تم رفع ملفات جديدة من الاستشاري')
            ->greeting('مرحباً ' . $notifiable->name)
            ->line('قام الاستشاري ' . $this->proposal->consultant->name . ' برفع ملفات جديدة على مشروعك: ' . $this->proposal->project->title)
            ->action('عرض الملفات', url('/projects/' . $this->proposal->project_id))
            ->line('يرجى مراجعة الملفات المرفوعة.');
    }

    public function toArray($notifiable)
    {
        return [
            'proposal_id' => $this->proposal->id,
            'project_id' => $this->proposal->project_id,
            'consultant_id' => $this->proposal->consultant_id,
            'consultant_name' => $this->proposal->consultant->name,
            'project_title' => $this->proposal->project->title,
        ];
    }
}
