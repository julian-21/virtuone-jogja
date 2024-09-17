<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDailyLimit extends Command
{
    protected $signature = 'reset:daily:limit';
    protected $description = 'Reset daily limit for jam selections';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Tambahkan logika di sini untuk mereset limit pemilihan jam

        // Contoh: Hapus semua pemilihan jam harian
        DB::table('formulirs')->update(['jam' => '']);

        $this->info('Daily limit reset successfully.');
    }
}
