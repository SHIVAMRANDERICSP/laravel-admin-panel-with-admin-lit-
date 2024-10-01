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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('country');
            $table->string('country_id');
            $table->string('state');
            $table->string('state_id');
            $table->string('city');
            $table->string('city_id');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('how_hear')->nullable();
            $table->boolean('tnc');
            $table->string('artist_name')->nullable();
            $table->string('artist_hidden')->nullable();
            $table->string('artist_image')->nullable();
            $table->string('spotify_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
