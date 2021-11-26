<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'org_id',
    ];

    public static function getOrgID($userid)
    {
        return (new static())->where('user_id', $userid)->first()->org_id;
    }
}
