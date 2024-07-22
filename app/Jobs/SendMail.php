<?php

namespace App\Jobs;

use App\Mail\InviteUserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $mailTo;

    /**
     * Create a new job instance.
     *
     * @param string $mailTo
     */
    public function __construct(string $mailTo)
    {
        $this->mailTo = $mailTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->mailTo)->send(new InviteUserMail());
    }
}
