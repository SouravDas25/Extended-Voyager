<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/27/2018
 * Time: 8:39 PM
 */

namespace TCG\Voyager\Http\Controllers;


use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Resources\VoyagerResources;

class VoyagerApiController extends Controller
{
    public function index(Request $request)
    {
        $slug = $this->getApiSlug($request);
        $apiType = Voyager::model('ApiType')->where('slug', '=', $slug)->first();
        //dd($apiType,$slug);
        $model = app($apiType->model_name);
        $query = $model::select('*');
        if ($apiType->paginate) $result = $query->paginate();
        else $result = $query->get();
        $ol = 'voyager.api.'.$apiType->slug.'.show';
        $result->each(function ($item, $key) use ($ol) {
            $item['object_link'] = route($ol,['id'=>$item->id]);
        });
        return VoyagerResources::collection($result);
    }

    public function show(Request $request, $id)
    {
        $slug = $this->getApiSlug($request);
        $apiType = Voyager::model('ApiType')->where('slug', '=', $slug)->first();
        $model = app($apiType->model_name);
        return new VoyagerResources($model::findOrFail($id));
    }
}