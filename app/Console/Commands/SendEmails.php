<?php

namespace App\Console\Commands;

use App\Mail\SendEmails as MailSendEmails;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to(Auth()->user())->send(new MailSendEmails());
    }
}
