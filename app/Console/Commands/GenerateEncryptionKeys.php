<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateEncryptionKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate encryption key and salt';

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
        $key = bin2hex(random_bytes(32)); // 64 characters
        $salt = bin2hex(random_bytes(16)); // 32 characters

        $this->info("ENCRYPTION_KEY=$key");
        $this->info("ENCRYPTION_SALT=$salt");
        return 0;
    }
}
