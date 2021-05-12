<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'event_id','start','end','color'
     ];
}
