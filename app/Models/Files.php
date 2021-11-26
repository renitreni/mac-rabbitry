<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'path',
        'filename',
        'extension',
        'size',
        'uploaded_by',
    ];

    public function getProfilePic($user_id)
    {
        return $this->where('uploaded_by', $user_id)->first();
    }

    public static function syncPhotos($model, $model_id, &$var)
    {
        $var = (new self)->query()
            ->where('model', $model)
            ->where('model_id', $model_id)
            ->whereNotIn('extension', ['mp4'])
            ->get();
    }

    public static function syncVideos($model, $model_id, &$var)
    {
        $var = (new self)->query()
            ->where('model', $model)
            ->where('model_id', $model_id)
            ->whereIn('extension', ['mp4'])
            ->first();
    }

    public static function countPhotos($model, $model_id)
    : int {
        return (new self)->query()
            ->where('model', $model)
            ->where('model_id', $model_id)
            ->whereNotIn('extension', ['mp4'])
            ->count();
    }

    public static function countVideos($model, $model_id)
    : int {
        return (new self)->query()
            ->where('model', $model)
            ->where('model_id', $model_id)
            ->whereIn('extension', ['mp4'])
            ->count();
    }
}
