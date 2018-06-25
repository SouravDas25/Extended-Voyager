<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/18/2018
 * Time: 5:01 PM
 */

namespace TCG\Voyager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;


class VoyagerApiBuilderController extends Controller
{
    public function index()
    {
        Voyager::canOrFail('browse_api');

        $dataTypes = Voyager::model('DataType')->select('id', 'name', 'slug')->get()->keyBy('name')->toArray();

        $tables = array_map(function ($table) use ($dataTypes) {
            $table = [
                'name'       => $table,
                'slug'       => isset($dataTypes[$table]['slug']) ? $dataTypes[$table]['slug'] : null,
                'dataTypeId' => isset($dataTypes[$table]['id']) ? $dataTypes[$table]['id'] : null,
            ];

            return (object) $table;
        }, SchemaManager::listTableNames());

        //dd($dataTypes,$tables);

        return view('voyager::tools.api.index',compact('dataTypes', 'tables'));
    }

    public function create(Request $request, $table)
    {
        Voyager::canOrFail('browse_api');

        $data = $this->prepopulateBreadInfo($table);
        $data['fieldOptions'] = SchemaManager::describeTable($table);
        $data['is_edit'] = false;

        //dd($data);

        return Voyager::view('voyager::tools.api.edit-add', $data);
    }

    private function prepopulateBreadInfo($table)
    {
        $displayName = Str::singular(implode(' ', explode('_', Str::title($table))));
        $modelNamespace = config('voyager.models.namespace', app()->getNamespace());
        if (empty($modelNamespace)) {
            $modelNamespace = app()->getNamespace();
        }

        return [
            'isModelTranslatable' => true,
            'table' => $table,
            'slug' => Str::slug($table),
            'display_name' => $displayName,
            'display_name_plural' => Str::plural($displayName),
            'model_name' => $modelNamespace . Str::studly(Str::singular($table)),
            'generate_permissions' => true,
            'server_side' => false,
        ];
    }

}