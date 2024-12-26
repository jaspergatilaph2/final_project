<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'company', 'email', 'phone', 'image'];
    public function appointments()
    {
        return $this->hasMany(Appointment::class); // A doctor can have many appointments
    }
    use HasFactory;
}
