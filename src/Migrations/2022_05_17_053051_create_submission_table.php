<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NadzorServera\Skijasi\Module\LMSModule\Helpers\DatabaseHelper;

class CreateSubmissionTable extends Migration
{
    private $tableName;

    public function __construct()
    {
        $this->tableName = DatabaseHelper::getSkijasiTableName('submissions');
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
            $table->foreignId('assignment_id');
            $table->foreignId('user_id');
            $table->text('file_url')->nullable();
            $table->text('link_url')->nullable();
            $table->timestamps();

            $table->foreign('assignment_id')
                ->references('id')
                ->on(DatabaseHelper::getSkijasiTableName('assignments'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')
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
