<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoInfo extends Model
{
    protected $table = 'video_infos';

    protected $guarded = [
      'username',
      'filename',
      'location'
    ];
}