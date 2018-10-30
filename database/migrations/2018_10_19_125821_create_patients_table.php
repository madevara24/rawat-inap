<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rm');
            $table->enum('treatment_type',['Umum','Persalinan']);
            $table->string('name');
            $table->date('birthday');
            $table->enum('gender',['Laki-Laki','Perempuan']);
            $table->string('disease_code');
            $table->enum('domicile',['DW','LW']);
            $table->enum('patient_type',['Lama','Baru']);
            $table->date('entry_date');
            $table->date('exit_date');
            $table->enum('payment_type',['UM','ASK','JAMKESMAS','BPJS','KIS','SPM']);
            $table->enum('release_note',['Pulang','Dirujuk','Meninggal > 48 jam','Meninggal < 48 jam']);
            $table->timestamps();

            $table->foreign('disease_code')
            ->references('disease_code')
            ->on('diseases')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
