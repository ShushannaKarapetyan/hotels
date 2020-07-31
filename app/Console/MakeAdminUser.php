<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class MakeAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {--email=} {--password=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin credentials';

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
     * @return mixed
     */
    public function handle()
    {
        if (!$this->option('email')) {
            $this->error('Admin email wasn\'t provided.');
            return;
        }
        if (!$this->option('password')) {
            $this->error('Admin password wasn\'t provided.');
            return;
        }

        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name') ?? 'Admin';

        User::create([
            'name'       => $name,
            'email'      => $email,
            'password'   => bcrypt($password),
        ]);

        $this->info("Admin User has been successfully created!");
    }
}
