<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('fullname', 150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('firstname', 30)->nullable();
            $table->string('lastname', 30)->nullable();
            $table->string('position', 30)->nullable();
            $table->string('email')->unique();

            $table->string('phone', 20)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('zip_code', 20)->nullable();
            
            $table->string('country', 100)->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('city', 100)->nullable();
            
            $table->string('username', 50)->nullable();
            $table->string('prefer_language', 200)->nullable();
            $table->boolean('newsletter')->nullable()->default(false);
            
            $table->string('facebookid', 100)->nullable();
            $table->string('googleid', 100)->nullable();
            $table->string('linkedinid', 100)->nullable();
            
            $table->integer('isquick')->nullable();
            $table->boolean('is_domain_admin')->default(false);
            
            $table->string('type_user', 8)->default('backend')->index();
            
            $table->boolean('status')->nullable()->default(false);
            $table->integer('logins')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
