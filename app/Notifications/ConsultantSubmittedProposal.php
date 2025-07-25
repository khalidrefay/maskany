<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ConsultantSubmittedProposal extends Notification
{
    protected $proposal;

    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'تم تقديم عرض جديد على مشروعك',
            'body' => 'قام الاستشاري ' . $this->proposal->consultant->name . ' بتقديم عرض على مشروعك.',
            'project_id' => $this->proposal->project_id,
            'proposal_id' => $this->proposal->id,
            'price' => $this->proposal->price,
            'duration' => $this->proposal->duration,
        ];
    }
}
