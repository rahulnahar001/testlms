<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cashbook;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mail', 'phone', 'address', 'credit_balance'];

    public function cashbooks()
    {
        return $this->hasMany(Cashbook::class);
    }
}
