<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 6/28/2018
 * Time: 11:33 AM
 */

namespace TCG\Voyager\Models;


use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = ['name','api_key'];
}