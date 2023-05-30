<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NadzorServera\Skijasi\Module\LMSModule\Helpers\DatabaseHelper;

class CreateMaterialCommentTable extends Migration
{
    private $tableName;

    public function __construct()
    {
        $this->tableName = DatabaseHelper::getSkijasiTableName('material_comments');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id');
            $table->text('content')->nullable();
            $table->foreignId('created_by');
            $table->timestamps();

            $table->foreign('material_id')
                ->references('id')
                ->on(DatabaseHelper::getSkijasiTableName('lesson_materials'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('created_by')
                ->references('id')
                ->on(DatabaseHelper::getSkijasiTableName('users'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
