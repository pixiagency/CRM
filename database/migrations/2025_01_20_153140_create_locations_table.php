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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            // Ensure parent_id is strictly enforced
            $table->foreign('parent_id')
            ->references('id')
            ->on('locations')
            ->onDelete('RESTRICT')  // Prevent deletion if it has children
            ->onUpdate('RESTRICT'); // Prevent parent_id update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
