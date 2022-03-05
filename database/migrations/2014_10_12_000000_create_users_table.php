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
        Schema::create('mktusers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location', 191)->nullable();
            $table->string('staffId')->unique();
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phoneno', 191)->nullable();
            $table->integer('department_id')->unsinged()->nullable();
            $table->integer('team_id')->unsinged()->nullable();
            $table->integer('region_id')->unsinged()->nullable();
            $table->boolean('leadership_worthy')->default(0);
            $table->integer('pinTarget')->default(0);
            $table->integer('newBusiness')->default(0);
            $table->double('financialTargetExisting')->default(0.00);
            $table->double('financialTargetNewBusiness')->default(0.00);
            $table->string('DOE')->nullable();
            $table->string('grade')->nullable();
            $table->string('annual_gross')->nullable();
            $table->datetime('start_date')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('status')->defualt(true);
            $table->string('slug');
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
