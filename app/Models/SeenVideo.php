<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeenVideo extends Model
{
    use HasFactory;
    protected $table = 'seen_videos';
    protected $fillable = [
       'customer_id',
       'video_id',
       'day_date'
  ];
}
