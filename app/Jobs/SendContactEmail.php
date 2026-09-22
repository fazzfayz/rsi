<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 30;
    public $tries = 3;

    protected $name;
    protected $email;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send('emails.contact', [
            'name' => $this->name,
            'email' => $this->email,
            'messageContent' => $this->message,
        ], function ($message) {
            $message->to('admin@ruang-solusi.com')
                    ->subject('📩 Pesan Baru dari Website Ruang Solusi')
                    ->from('info@ruang-solusi.com', $this->name)
                    ->replyTo($this->email, $this->name);
        });
    }
}
