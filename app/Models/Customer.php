<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Casebook;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mail', 'phone', 'address', 'credit_balance'];

    public function casebooks()
    {
        return $this->hasMany(Casebook::class);
    }
}
