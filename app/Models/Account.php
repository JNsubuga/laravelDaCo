<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'Name', 'Code', 'AnualPrinciple'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('year', 'like', '%' . request('search') . '%')
                ->orWhere('Name', 'like', '%' . request('search') . '%')
                ->orWhere('Code', 'like', '%' . request('search') . '%');
        }
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_account');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
