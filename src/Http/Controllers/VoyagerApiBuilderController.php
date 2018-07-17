<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/18/2018
 * Time: 5:01 PM
 */

namespace TCG\Voyager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\ApiType;


class VoyagerApiBuilderController extends Controller
{
    public function index()
    {
        Voyager::canOrFail('browse_api-builder');

        $dataTypes = Voyager::model('ApiType')->select('id', 'name', 'slug')->get()->keyBy('name')->toArray();

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
        Voyager::canOrFail('browse_api-builder');

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
            'paginate' => false,
        ];
    }

    public function store(Request $request)
    {
        Voyager::canOrFail('browse_api-builder');
        $vd = $request->validate([
            'name' => 'required|unique:api_types',
            'display_name_singular' => 'required',
            'display_name_plural' => 'required',
            'slug' => 'required',
            'model_name' => 'required',
            'controller' => 'sometimes',
            'description' => 'sometimes',
            'paginate' => 'sometimes',
        ]);
        //dd($vd);
        $api_type = ApiType::create($vd);
        return Redirect::route('voyager.api.builder.index');
    }

    public function edit($table)
    {
        Voyager::canOrFail('browse_api-builder');
        $data = $this->prepopulateBreadInfo($table);
        $data['fieldOptions'] = SchemaManager::describeTable($table);
        $data['is_edit'] = true;
        $data['api_type'] = Voyager::model('ApiType')->whereName($table)->firstOrFail();
        //dd($data);
        return Voyager::view('voyager::tools.api.edit-add', $data);
    }

    public function update(Request $request, $id)
    {
        Voyager::canOrFail('browse_api-builder');
        try {
            $api_type = Voyager::model('ApiType')->find($id);
            $vd = $request->validate([
                'name' => 'required|unique:api_types,name,'.$id,
                'display_name_singular' => 'required',
                'display_name_plural' => 'required',
                'slug' => 'required',
                'model_name' => 'required',
                'controller' => 'sometimes',
                'description' => 'sometimes',
                'paginate' => 'sometimes',
            ]);
            if(array_key_exists('paginate',$vd) == false)  {
                $vd['paginate'] = 0;
            }
            $api_type->fill($vd);
            $api_type->save();
            $data = $this->alertSuccess("Successfully Updated $api_type->name Api Resource.");
            return redirect()->route('voyager.api.builder.index')->with($data);
        } catch (Exception $e) {
            return back()->with($this->alertException($e, __('voyager::generic.update_failed')));
        }

    }

    public function show($id)
    {
        Voyager::canOrFail('browse_api-builder');
        $apiType = Voyager::model('ApiType')->find($id);
        return Voyager::view('voyager::tools.api.browse', compact('apiType'));
    }

    public function destroy($id)
    {
        Voyager::canOrFail('browse_api-builder');
        $api_type = Voyager::model('ApiType')->find($id);

        $res = Voyager::model('ApiType')->destroy($id);
        $data = $res
            ? $this->alertSuccess("Successfully Deleted $api_type->name Api Resource.")
            : $this->alertError("Error while deleting the Api Resource");
        return redirect()->route('voyager.api.builder.index')->with($data);
    }

}