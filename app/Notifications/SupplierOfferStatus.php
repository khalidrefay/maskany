<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProjectOffer;

class SupplierOfferStatus extends Notification implements ShouldQueue
{
    use Queueable;

    protected $offer;
    protected $status;

    public function __construct(ProjectOffer $offer, $status)
    {
        $this->offer = $offer;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $msg = $this->status == 'accepted' ? 'تم قبول عرضك للمواد' : 'تم رفض عرضك للمواد';
        return (new MailMessage)
            ->subject($msg)
            ->greeting('مرحباً ' . $notifiable->name)
            ->line($msg . ' في مشروع: ' . $this->offer->project->title)
            ->action('عرض المشروع', url('/supplier/projects/' . $this->offer->project_id))
            ->line('شكراً لتعاملك معنا.');
    }

    public function toArray($notifiable)
    {
        return [
            'offer_id' => $this->offer->id,
            'project_id' => $this->offer->project_id,
            'status' => $this->status,
            'project_title' => $this->offer->project->title,
        ];
    }
    protected $fillable = ['project_id', 'message', 'read_at'];

public function project()
{
    return $this->belongsTo(Project::class);
}

public function markAsRead()
{
    $this->update(['read_at' => now()]);
}
}
