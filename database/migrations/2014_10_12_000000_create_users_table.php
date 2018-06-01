<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('role_id')->index()->unsigned()->nullable()->default(4);
			$table->unsignedTinyInteger('is_miami')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('has_deleted')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });

		User::create(['name' => 'Super Administrator', 'email' => 'admin@localhost', 'password' => Hash::make(env('APP_KEY')), 'role_id' => 1]);
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
