<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    //protected $guarded = [];
    protected $fillable = ['name', 'address', 'email', 'website'];

    public function contacts()
    {
        return $this->hasMany(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
