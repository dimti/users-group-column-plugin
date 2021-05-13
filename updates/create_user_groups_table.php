<?php namespace Dimti\UserGroup\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateUserGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('dimti_user-group_user_groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dimti_user-group_user_groups');
    }
}
