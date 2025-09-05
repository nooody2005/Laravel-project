<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddphotoToDepartmentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('departments', 'photo')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->string('photo')->nullable()->after('name');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('departments', 'photo')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('photo');
            });
        }
    }
}
