<?php

namespace App\Jobs;

use App\Mail\UserPasswordMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserPasswordEmail implements ShouldQueue
{
    use Queueable;

    private User $user;
    private string $password;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new UserPasswordMail($this->user, $this->password));
    }
}
