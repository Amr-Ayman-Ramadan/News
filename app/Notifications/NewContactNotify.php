<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewContactNotify extends Notification
{
    use Queueable;

    public $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
    }


    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            "contact_title" => $this->contact->title,
            "user_name"=>$this->contact->name,
            "date"=> date("Y-m-d H:i:s"),
            "link"=>route("admin.contact.show",$this->contact->id)
        ];
    }
//    public function toBroadcast(object $notifiable): BroadcastMessage
//    {
//        return new BroadcastMessage([
//            'contact_title' => $this->contact->title,
//            'user_name' => $this->contact->name,
//            'link' => route('admin.contact.show', $this->contact->id),
//        ]);
//    }
    public function broadcastType(): string
    {
        return 'NewContactNotify';
    }
    public function databaseType(): string
    {
        return 'NewContactNotify';
    }
}
