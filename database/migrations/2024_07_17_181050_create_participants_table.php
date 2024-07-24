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

            // Champs supplémentaires
            $table->string('numero_recu')->nullable();
            $table->string('s1')->nullable();
            $table->date('date_s1')->nullable();
            $table->string('s2')->nullable();
            $table->date('date_s2')->nullable();
            $table->string('s3')->nullable();
            $table->date('date_s3')->nullable();
            $table->string('s4')->nullable();
            $table->date('date_s4')->nullable();
            $table->string('centre')->nullable();
            $table->date('date_centre')->nullable();

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
