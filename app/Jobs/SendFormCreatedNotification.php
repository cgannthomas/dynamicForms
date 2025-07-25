<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail\FormCreatedMail;

class SendFormCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $formData;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->formData = $data;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new FormCreatedMail($this->formData));
    }
}
