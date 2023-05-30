<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NadzorServera\Skijasi\Module\LMSModule\Helpers\DatabaseHelper;

class CreateAssignmentsTable extends Migration
{
    private $tableName;

    public function __construct()
    {
        $this->tableName = DatabaseHelper::getSkijasiTableName('assignments');
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
            $table->foreignId('course_id');
            $table->foreignId('topic_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('point')->nullable();
            $table->text('file_url')->nullable();
            $table->text('link_url')->nullable();
            $table->timestampTz('due_date')->nullable();
            $table->foreignId('created_by');
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')
                ->on(DatabaseHelper::getSkijasiTableName('courses'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('topic_id')
                ->references('id')
                ->on(DatabaseHelper::getSkijasiTableName('topics'))
                ->onDelete('set null')
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
