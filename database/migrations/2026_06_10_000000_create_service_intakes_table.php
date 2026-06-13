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
        Schema::create('service_intakes', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique();
            $table->string('nama_pelanggan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('tipe_perangkat')->nullable();
            $table->string('device_type')->default('laptop');
            $table->date('tanggal_masuk')->nullable();
            $table->string('processor')->nullable();
            $table->string('gpu')->nullable();
            $table->string('ram')->nullable();
            $table->text('storage')->nullable();
            $table->json('components')->nullable();
            $table->json('service_types')->nullable();
            $table->text('kerusakan_inti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_intakes');
    }
};
