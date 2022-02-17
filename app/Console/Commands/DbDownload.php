<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;


class DbDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Downloaded';

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

        $username = env("DB_USERNAME");
        $password = env("DB_PASSWORD");
        $db_name = env("DB_DATABASE");
        $name = 'Backup_'.Carbon::Now()->format('d.m.Y').'.sql';
        $upload_path = public_path('database/backup/');
        $full_path = $upload_path.$name;

        exec("mysqldump -u$username -p$password $db_name > $full_path");

        $headers = array(
          'Content-Type: application/sql',
        );
        return redirect()->back();
    }
}
