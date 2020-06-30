<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Router extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $table = 'routers';
    protected $fillable = [
        'sap_id',
        'hostname',
        'type',
        'loopback',
        'mac_address'
    ];

    protected $hidden = [
        'api_token',
    ];

    public static function getRecords()
    {
        return self::all();
    }
}
