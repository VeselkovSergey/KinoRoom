<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('subscription_start_date')->nullable();
            $table->date('subscription_end_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        \App\Models\User::query()->create([
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin@admin.com'),
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
            'subscription_start_date' => now()->format('Y-m-d'),
            'subscription_end_date' => now()->addYear(10)->format('Y-m-d'),
        ]);
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
};
