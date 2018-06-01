<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Scheme;

class CreateSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('key')->unique();
			$table->string('name')->unique();
			$table->integer('order');
			$table->string('type');
            $table->timestamps();
        });

		Scheme::create(['order' => 1, 'key' => 'species_name', 'name' => 'Species Name', 'type' => 'input']);
		Scheme::create(['order' => 2, 'key' => 'common_name', 'name' => 'Common Name', 'type' => 'input']);
        Scheme::create(['order' => 3, 'key' => 'miami_name', 'name' => 'Miami Name', 'type' => 'input']);
        Scheme::create(['order' => 4, 'key' => 'family', 'name' => 'Family', 'type' => 'input']);
          
        Scheme::create(['order' => 5, 'key' => 'combo7', 'name' => 'Combo7', 'type' => 'boolean']);
        Scheme::create(['order' => 6, 'key' => 'combo9', 'name' => 'Combo9', 'type' => 'boolean']);
        Scheme::create(['order' => 7, 'key' => 'food', 'name' => 'FOOD', 'type' => 'boolean']);
        Scheme::create(['order' => 8, 'key' => 'medicinal', 'name' => 'MEDICINAL', 'type' => 'boolean']);
        Scheme::create(['order' => 9, 'key' => 'material', 'name' => 'MATERIAL', 'type' => 'boolean']);
        Scheme::create(['order' => 10, 'key' => 'customsl', 'name' => 'CUSTOMSl', 'type' => 'boolean']);
        Scheme::create(['order' => 11, 'key' => 'technology', 'name' => 'TECHNOLOGY', 'type' => 'boolean']);
        Scheme::create(['order' => 12, 'key' => 'attachment', 'name' => 'Attachment', 'type' => 'boolean']);
        Scheme::create(['order' => 13, 'key' => 'olebound60', 'name' => 'OLEBound60', 'type' => 'boolean']);
        Scheme::create(['order' => 14, 'key' => 'beech_maple_forest', 'name' => 'Beech-Maple Forest', 'type' => 'boolean']);
        Scheme::create(['order' => 15, 'key' => 'oak_forest', 'name' => 'Oak Forest (including Oak-Hickory)', 'type' => 'boolean']);
        Scheme::create(['order' => 16, 'key' => 'beech_oak_maple', 'name' => 'Beech-Oak-Maple (Mixed Mesophytic)', 'type' => 'boolean']);
        Scheme::create(['order' => 17, 'key' => 'oak_savanna', 'name' => 'Oak Savanna (with openings, barrens)', 'type' => 'boolean']);
        Scheme::create(['order' => 18, 'key' => 'dry_prairie', 'name' => 'Dry Prairie (grasslands)', 'type' => 'boolean']);
        Scheme::create(['order' => 19, 'key' => 'wet_prairie', 'name' => 'Wet Prairie (grasslands with flooding)', 'type' => 'boolean']);
        Scheme::create(['order' => 20, 'key' => 'lowland_deciduous', 'name' => 'Lowland Deciduous (floodplains, riparian)', 'type' => 'boolean']);
        Scheme::create(['order' => 21, 'key' => 'conifer_shrubland_and_forest', 'name' => 'Conifer Shrubland and Forest', 'type' => 'boolean']);
        Scheme::create(['order' => 22, 'key' => 'conifer_swamp', 'name' => 'Conifer Swamp (some deciduous domts.)', 'type' => 'boolean']);
        Scheme::create(['order' => 23, 'key' => 'deciduous_swamp', 'name' => 'Deciduous Swamp (no coniferous domts.)', 'type' => 'boolean']);
        Scheme::create(['order' => 24, 'key' => 'wetland', 'name' => 'Wetland (marsh, fen, mdw, bog, pond, shore)', 'type' => 'boolean']);
        Scheme::create(['order' => 25, 'key' => 'geboe_property', 'name' => 'Geboe Property', 'type' => 'boolean']);
        Scheme::create(['order' => 26, 'key' => 'liebert_property', 'name' => 'Liebert Property', 'type' => 'boolean']);
        Scheme::create(['order' => 27, 'key' => 'grant_property', 'name' => 'Grant Property', 'type' => 'boolean']);
        Scheme::create(['order' => 28, 'key' => 'other1', 'name' => 'Other1', 'type' => 'boolean']);
        Scheme::create(['order' => 29, 'key' => 'seven_pillars', 'name' => 'Seven Pillars', 'type' => 'boolean']);
        Scheme::create(['order' => 30, 'key' => 'other2', 'name' => 'Other2', 'type' => 'boolean']);
        Scheme::create(['order' => 31, 'key' => 'agricultural_areas', 'name' => 'Agricultural Areas (crops fields, fencerows, ditches)', 'type' => 'boolean']);
        Scheme::create(['order' => 32, 'key' => 'human_disturbed_areas', 'name' => 'Human-Disturbed Areas', 'type' => 'boolean']);
        Scheme::create(['order' => 33, 'key' => 'tree', 'name' => 'Tree', 'type' => 'boolean']);
        Scheme::create(['order' => 34, 'key' => 'shrub', 'name' => 'Shrub', 'type' => 'boolean']);
        Scheme::create(['order' => 35, 'key' => 'herb', 'name' => 'Herb', 'type' => 'boolean']);
        Scheme::create(['order' => 36, 'key' => 'vine', 'name' => 'Vine', 'type' => 'boolean']);
        Scheme::create(['order' => 37, 'key' => 'unkn', 'name' => 'Unkn', 'type' => 'boolean']);
        Scheme::create(['order' => 38, 'key' => 'winter', 'name' => 'Winter', 'type' => 'boolean']);
        Scheme::create(['order' => 39, 'key' => 'summer', 'name' => 'Summer', 'type' => 'boolean']);
        Scheme::create(['order' => 40, 'key' => 'fall', 'name' => 'Fall', 'type' => 'boolean']);
        Scheme::create(['order' => 41, 'key' => 'spring', 'name' => 'Spring', 'type' => 'boolean']);
        Scheme::create(['order' => 42, 'key' => 'in_dictionary', 'name' => 'In Dictionary', 'type' => 'boolean']);
        Scheme::create(['order' => 43, 'key' => 'include_in_pubs', 'name' => 'Include in Pubs', 'type' => 'boolean']);
        Scheme::create(['order' => 44, 'key' => 'na', 'name' => 'NA', 'type' => 'boolean']);
        Scheme::create(['order' => 45, 'key' => 'cultivated', 'name' => 'Cultivated', 'type' => 'boolean']);
        Scheme::create(['order' => 46, 'key' => 'wild', 'name' => 'Wild', 'type' => 'boolean']);


        Scheme::create(['order' => 47, 'key' => 'alt_word_form', 'name' => 'Alt. Word Form', 'type' => 'input']);
        Scheme::create(['order' => 48, 'key' => 'related_words', 'name' => 'Related Words', 'type' => 'input']);
        Scheme::create(['order' => 49, 'key' => 'earliest_record', 'name' => 'Earliest Record', 'type' => 'input']);
        Scheme::create(['order' => 50, 'key' => 'latest_record', 'name' => 'Latest Record', 'type' => 'input']);

        Scheme::create(['order' => 51, 'key' => 'french_name', 'name' => 'French Name', 'type' => 'input']);
        Scheme::create(['order' => 52, 'key' => 'photo', 'name' => 'photo', 'type' => 'photo']);
        Scheme::create(['order' => 53, 'key' => 'audio', 'name' => 'audio', 'type' => 'audio']);
        Scheme::create(['order' => 54, 'key' => 'description', 'name' => 'Description', 'type' => 'textarea']);
		Scheme::create(['order' => 55, 'key' => 'habitat', 'name' => 'Habitat', 'type' => 'textarea']);
		Scheme::create(['order' => 56, 'key' => 'cultural_use', 'name' => 'Cultural Use', 'type' => 'textarea']);
		Scheme::create(['order' => 57, 'key' => 'horticultural_info', 'name' => 'Horticultural Info', 'type' => 'textarea']);
		Scheme::create(['order' => 58, 'key' => 'ecological_info', 'name' => 'Ecological Info', 'type' => 'textarea']);
		Scheme::create(['order' => 59, 'key' => 'related_info', 'name' => 'Related Info', 'type' => 'textarea']);
		Scheme::create(['order' => 60, 'key' => 'literal_meaning', 'name' => 'Literal Meaning', 'type' => 'textarea']);
		Scheme::create(['order' => 61, 'key' => 'discussion_log', 'name' => 'Discussion Log', 'type' => 'textarea']);
		Scheme::create(['order' => 62, 'key' => 'researcher_note', 'name' => 'Researcher Note', 'type' => 'textarea']);

	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schemes');
    }
}
