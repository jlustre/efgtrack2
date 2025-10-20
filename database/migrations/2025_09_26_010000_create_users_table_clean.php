<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
            $table->string('username')->unique()->nullable();
            $table->foreignId('sponsor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('rank_id')->nullable()->constrained('ranks')->onDelete('cascade')->default(1);
            $table->foreignId('assigned_mentor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('state_id')->nullable()->constrained('states_provinces')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->string('postal_code')->nullable();
            $table->string('timezone')->nullable();
            $table->json('best_contact_times')->nullable();
            $table->float('profile_completed', 5, 2)->default(0.00);
            $table->boolean('is_licensed')->default(false);
            $table->boolean('is_online')->default(false);
            $table->date('last_active_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('language')->default('en');
            $table->enum('member_status', ['pending', 'active', 'inactive', 'suspended'])->default('pending');
            $table->json('theme_settings')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['sponsor_id', 'member_status']);
            $table->index(['member_status', 'created_at']);
            $table->index(['city', 'state_id', 'country_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
