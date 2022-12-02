<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Imagine we had some old enum values which were replaced by new ones in the app
 * level code.
 *
 *
 */
return new class extends Migration
{
    private function getTransformations() : array
    {
        return [
            'cat_old' => 'cat',
            'dog_old' => 'dog'
        ];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->getTransformations() as $oldValue => $newValue)
        {
            DB::table('pets')
                ->where('type', $oldValue)
                ->update(['type' => $newValue]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->getTransformations() as $oldValue => $newValue)
        {
            DB::table('pets')
                ->where('type', $newValue)
                ->update(['type' => $oldValue]);
        }
    }
};
