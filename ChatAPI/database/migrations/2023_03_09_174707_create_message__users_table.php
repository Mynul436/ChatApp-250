<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message__users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('read')->default(false);
            $table->boolean('deleted')->default(false);
            $table->boolean('archived')->default(false);
            $table->boolean('pinned')->default(false);
            $table->boolean('starred')->default(false);
            $table->boolean('muted')->default(false);
            $table->boolean('sent')->default(false);
            $table->boolean('received')->default(false);
            $table->boolean('seen')->default(false);
            $table->boolean('replied')->default(false);
            $table->boolean('forwarded')->default(false);
            $table->boolean('edited')->default(false);
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message__users');
    }
};
