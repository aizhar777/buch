<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePpc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->text('description');
            $table->timestamps();

            try {
                \DB::statement('ALTER TABLE ppc ADD FULLTEXT search(code, description)');
            }catch (\Exception $e){
                $table->index('code');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppc');
    }
}
