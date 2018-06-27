<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/26/2018
 * Time: 9:23 PM
 */

namespace TCG\Voyager\Models;


use Illuminate\Database\Eloquent\Model;

class ApiType extends Model
{
    protected $fillable = ['name','slug','display_name_singular',
        'display_name_plural','model_name','controller','description','paginate'];

    public function setPaginateAttribute($value)
    {
        $this->attributes['paginate'] = $value ? 1 : 0;
    }
}