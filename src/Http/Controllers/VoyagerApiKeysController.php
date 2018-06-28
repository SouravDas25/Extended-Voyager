<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/28/2018
 * Time: 11:20 AM
 */

namespace TCG\Voyager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\ApiKey;

class VoyagerApiKeysController extends Controller
{
    public function index()
    {
        $apiKeys = Voyager::model('ApiKey')->all();
        return Voyager::view('voyager::tools.api.keys.index', compact('apiKeys'));
    }

    public function store(Request $request)
    {
        $vd = $request->validate([
            'name' =>'required'
        ]);
        $vd['api_key'] = Str::random();
        $ak = ApiKey::create($vd);
        return redirect()->route('voyager.api-keys.index');
    }

    public function edit(Request $request,$id)
    {
        $ak = ApiKey::findOrFail($id);
        $ak->block = !$ak->block;
        $ak->save();
        return $ak;
    }
    public function destroy($id)
    {
        $ak = ApiKey::destroy($id);
        if($ak) $this->alertSuccess("API Deleted Successfully");
        else $this->alertError("Cannot Be Deleted");
        return redirect()->route('voyager.api-keys.index');
    }
}
