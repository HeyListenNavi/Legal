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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("full_name")->index();
            $table->string("person_type");
            $table->string("phone_number");
            $table->string("email")->nullable();
            $table->string("curp");
            $table->string("rfc")->nullable();
            $table->string("address")->nullable();
            $table->string("ine_id")->nullable();
            $table->string("ocupation")->nullable();
            $table->dateTime("date_of_birth");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
