<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centre_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('active');
            $table->string('nom_prenom')->nullable();
            $table->string('numero_cin')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('ville_naissance')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville_centre')->nullable();
            $table->string('telephone')->nullable();
            $table->string('categorie')->nullable(); // enums
            $table->decimal('montant_inscription', 10, 2)->nullable();
            $table->string('commercial')->nullable();
            $table->string('etat')->default('Non')->nullable();
            $table->decimal('reste', 10, 2)->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
