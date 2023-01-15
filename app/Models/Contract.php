<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','email','phone','address'];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}