<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use TCG\Voyager\Facades\Voyager;

/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/17/2018
 * Time: 2:54 PM
 */

class VoyagerUniversalSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        $data = File::get(Voyager::seedDataFilePath());
        $data = json_decode($data,true);
        foreach ($data as $model => $rows) {
            $modelClass = Voyager::model($model);
            $modelClass::query()->truncate();
            foreach ($rows as $row){
                $modelObj = new $modelClass();
                foreach ($row as $key => $value) {
                    $modelObj->${$key} = $value;
                }
                $modelObj->save();
            }
        }
        DB::commit();
    }
}