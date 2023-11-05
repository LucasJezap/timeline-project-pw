<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('timeline_events', function ($table) {
            $table->string('description', 2000)->change();
        });
        Schema::table('categories', function ($table) {
            $table->string('description', 2000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
