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
            $table->string('nom_prenom');
            $table->string('numero_cin');
            $table->date('date_naissance');
            $table->string('ville_naissance');
            $table->string('adresse');
            $table->string('ville_centre');
            $table->string('telephone');
            $table->string('categorie');
            $table->decimal('montant_inscription', 10, 2);
            $table->string('commercial');
            $table->string('etat')->default('Non');
            $table->decimal('reste', 10, 2)->default(0);
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
