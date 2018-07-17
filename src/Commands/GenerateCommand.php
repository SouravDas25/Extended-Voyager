<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/16/2018
 * Time: 2:38 PM
 */

namespace TCG\Voyager\Commands;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\InputOption;
use TCG\Voyager\Facades\Voyager;

class GenerateCommand extends Command
{
    protected $signature  = 'voyager:generate ';

    protected $description = 'Generates beard data seeds created by the user on different tables.';

    protected $filesystem;

    /**
     * GenerateCommand constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    public function fire()
    {
        return $this->handle();
    }

    /*protected function getOptions()
    {
        return [
            ['bread', null, InputOption::VALUE_NONE, 'Generates all the bread seed needed by the app for db.', null],
        ];
    }*/

    public function handle()
    {
        $this->generateBread();
    }

    /**
     *
     */
    public function generateBread()
    {
        //$this->info('Bread Defined');
        $table_names = Voyager::table_names();
        $beardsObj = [];
        foreach ($table_names as $name){
            if( Schema::hasTable($name) ) {
                //$this->info("Found table $name.");
                $beardsObj[$name] = DB::table($name)->get();
                $this->info("Generated seed data for $name model");
            }
            else {
                $this->info("Table $name not found.");
            }
        }
        $path = Voyager::seedDataFolderPath();
        //$this->info($path);
        if (!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path);
        }
        $data = json_encode($beardsObj, JSON_PRETTY_PRINT);
        $path = Voyager::seedDataFilePath();
        $this->filesystem->put($path,$data);
        $this->info("All Seed Data Generated.");
    }
}