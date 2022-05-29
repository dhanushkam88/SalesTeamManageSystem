<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact')->after('email_verified_at')->default(0);
            $table->bigInteger('manager_id')->after('contact')->unsigned()->default(0);
            $table->bigInteger('status')->after('manager_id')->default(1)->comment('1=inactive, 2=active')->unsigned();
            $table->foreign('status')->references('id')->on('user_statuses');
            $table->string('joined_date')->after('status')->nullable();
            $table->string('current_route')->after('joined_date')->nullable();
            $table->string('address')->after('current_route')->default(0);
            $table->string('city')->after('address')->default(0);
            $table->string('province')->after('city')->default(0);
            $table->bigInteger('zip')->after('province')->default(0);
            $table->text('comment')->after('profile_photo_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
