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
            $table->string('status_name')->unique();
            $table->timestamps();
        });

        DB::table('post_statuses')->insert([
            ['status_name' => 'public'],
            ['status_name' => 'private'],
        ]);

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('post_statuses_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_statuses');

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['post_statuses_id']);
            $table->dropColumn('post_statuses_id');
        });
    }
};
