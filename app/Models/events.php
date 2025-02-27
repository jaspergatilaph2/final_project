<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    protected $fillable = ['eventsName', 'description', 'eventsText'];
    protected $table = 'events';
    use HasFactory;
}
