<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integerIncrements('id_users');
            $table->enum('role',['admin','user']); // change role as you wish
            $table->string('nama');
            $table->string('email')->unique(); // opsional. can use email or username
            $table->timestamp('email_verified_at')->nullable(); // delete this if not in use
            $table->string('username')->unique(); // opsional. can use email or username
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
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
