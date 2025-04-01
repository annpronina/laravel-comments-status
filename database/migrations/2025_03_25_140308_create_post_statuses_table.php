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
        Schema::create('post_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_id')->unique();
            $table->timestamps();
        });

        DB::table('post_statuses')->insert([
            ['status_id' => 'public'],
            ['status_id' => 'private'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_statuses');
    }
};
