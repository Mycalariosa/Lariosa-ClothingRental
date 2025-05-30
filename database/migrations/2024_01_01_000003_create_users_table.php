<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_contact_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('user_status_id')->constrained('user_statuses');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert admin user after creating the table
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'user_contact_number' => '1234567890',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'user_status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insert admin user
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
