<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset administrators password';

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
        $email = $this->argument('email');
        $password = $this->argument('password');

        if($email == '') {
            echo 'email cannot be empty\r\n';
        } elseif($password == '') {
            echo 'password cannot be empty\r\n';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != 'admin@localhost') {
            echo 'invalid email\r\n';
        } elseif(!count(User::where(['email' => $email])->get()->toArray())) {
            echo 'user does not exist\r\n';
        } elseif(User::where(['email' => $email])->get()->toArray()[0]['role_id'] != 1) {
            echo 'this user is not administrator. this command is used to reset administrator\'s password only\r\n';
        } else {
            $id = User::where(['email' => $email])->get()->toArray()[0]['id'];
            User::find($id)->update(['password' => Hash::make($password)]);
            echo "password reset successfully\r\n";
        }
    }
}
