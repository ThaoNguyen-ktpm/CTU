<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $NoiDung;
    protected $Email;

    /**
     * Create a new job instance.
     *
     * @param string $NoiDung
     * @param string $Email
     * @return void
     */
    public function __construct($NoiDung, $Email)
    {
        $this->NoiDung = $NoiDung;
        $this->Email = $Email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('Email.ThongBaoemail', ['OTP' => $this->NoiDung], function ($message) {
            $message->to($this->Email);
            $message->subject('Thông Báo');
        });
    }
}
