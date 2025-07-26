<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteExpiredOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes expired OTP records from password_reset_tokens table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Clean up expired OTPs
        DB::table('password_reset_tokens')
            ->where('created_at', '<', now()->subMinutes(2))
            ->delete();

        $this->info('Expired OTPs cleaned up successfully.');
    }
}
