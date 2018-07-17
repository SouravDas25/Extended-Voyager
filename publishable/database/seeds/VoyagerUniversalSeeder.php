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
    /**
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();
        $data = File::get(Voyager::seedDataFilePath());
        $data = json_decode($data,true);
        //print_r($data) ;
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        try {
            foreach ($data as $table_name => $rows) {
                //DB::table($table_name)->truncate();
                DB::table($table_name)->insert($rows);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            throw $exception;
        }
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::commit();
    }
}