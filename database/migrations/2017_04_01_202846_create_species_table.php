<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
			$table->string('oid');
			$table->integer('user_id')->index()->unsigned()->nullable();
			$table->unsignedInteger('version')->default(0);
			$table->unsignedTinyInteger('is_approved')->default(1);

			$table->text('species_name')->nullable();
			$table->text('common_name')->nullable();
			$table->text('family')->nullable();
			$table->text('miami_name')->nullable();
			$table->text('description')->nullable();
			$table->text('habitat')->nullable();
			$table->text('combo7')->nullable();
			$table->text('combo9')->nullable();
			$table->text('food')->nullable();
			$table->text('medicinal')->nullable();
			$table->text('material')->nullable();
			$table->text('customsl')->nullable();
			$table->text('technology')->nullable();
			$table->text('cultural_use')->nullable();
			$table->text('horticultural_info')->nullable();
			$table->text('ecological_info')->nullable();
			$table->text('related_info')->nullable();
			$table->text('attachment')->nullable();
			$table->text('alt_word_form')->nullable();
			$table->text('french_name')->nullable();
			$table->text('literal_meaning')->nullable();
			$table->text('olebound60')->nullable();
			$table->text('beech_maple_forest')->nullable();
			$table->text('oak_forest')->nullable();
			$table->text('beech_oak_maple')->nullable();
			$table->text('oak_savanna')->nullable();
			$table->text('dry_prairie')->nullable();
			$table->text('wet_prairie')->nullable();
			$table->text('lowland_deciduous')->nullable();
			$table->text('conifer_shrubland_and_forest')->nullable();
			$table->text('conifer_swamp')->nullable();
			$table->text('deciduous_swamp')->nullable();
			$table->text('wetland')->nullable();
			$table->text('geboe_property')->nullable();
			$table->text('liebert_property')->nullable();
			$table->text('grant_property')->nullable();
			$table->text('other1')->nullable();
			$table->text('seven_pillars')->nullable();
			$table->text('other2')->nullable();
			$table->text('agricultural_areas')->nullable();
			$table->text('human_disturbed_areas')->nullable();
			$table->text('tree')->nullable();
			$table->text('shrub')->nullable();
			$table->text('herb')->nullable();
			$table->text('vine')->nullable();
			$table->text('unkn')->nullable();
			$table->text('winter')->nullable();
			$table->text('summer')->nullable();
			$table->text('fall')->nullable();
			$table->text('spring')->nullable();
			$table->text('related_words')->nullable();
			$table->text('in_dictionary')->nullable();
			$table->text('include_in_pubs')->nullable();
			$table->text('na')->nullable();
			$table->text('cultivated')->nullable();
			$table->text('wild')->nullable();
			$table->text('earliest_record')->nullable();
			$table->text('latest_record')->nullable();
			$table->text('photo')->nullable();
			$table->text('audio')->nullable();
			$table->text('discussion_log')->nullable();
			$table->text('researcher_note')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
