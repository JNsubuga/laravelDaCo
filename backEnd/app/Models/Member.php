<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['Names', 'Code', 'Contacts'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Names', 'like', '%' . request('search') . '%')
                ->orWhere('Code', 'like', '%' . request('search') . '%')
                ->orWhere('Contacts', 'like', '%' . request('search') . '%');
        }
    }


    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'member_account');
    }

    // public function memberaccount()
    // {
    //     return $this->hasOne(Memberaccount::class);
    // }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function nok()
    {
        return $this->hasOne(Nok::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
