<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['event_id','eventsName', 'description', 'eventsText', 'date', '.time', 'endtime', 'is_read'];
    protected $table = 'events';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
