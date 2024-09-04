<?php

namespace App\Jobs;

use App\Mail\UserCredentialsMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendCreatedUserCredentials implements ShouldQueue
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
        Mail::to($this->user->email)->send(new UserCredentialsMail($this->user, $this->password));
    }
}
