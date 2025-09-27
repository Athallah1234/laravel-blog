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
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('avatar');
            $table->string('twitter')->nullable()->after('bio');
            $table->string('instagram')->nullable()->after('twitter');
            $table->string('github')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('github');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'twitter',
                'instagram',
                'github',
                'linkedin',
            ]);
        });
    }
};
