<?php

namespace App\Models;

use App\Scopes\ContractSearchScope;
use App\Scopes\FilterScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id','user_id'];
    public $searchColumns = ['first_name', 'last_name', 'email', 'company.name'];
    public $filterColumns = ['company_id'];
    protected $with = ['company'];
    public function company()
    {
        return $this->belongsTo(Company::class)->withoutGlobalScopes();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new ContractSearchScope);
    }   
    
}
