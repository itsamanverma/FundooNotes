<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Notifications\VerificationMail;

class TestMail extends Command
{
    protected $signature = 'mail:test {email}';
    protected $description = 'Test email configuration by sending a test email';

    public function handle()
    {
        $email = $this->argument('email');
        
        try {
            // Create a dummy user for testing
            $testUser = new User();
            $testUser->email = $email;
            $testUser->firstname = 'Test';
            $testUser->lastname = 'User';
            
            $verifyToken = 'test-token-12345';
            
            $testUser->notify(new VerificationMail($email, $verifyToken));
            
            $this->info("✅ Test email sent successfully to: {$email}");
            $this->info("Check your email inbox or the log files in storage/logs/");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->info("💡 Check your SMTP credentials in .env file");
        }
    }
}