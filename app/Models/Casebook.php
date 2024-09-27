<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Casebook extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'credit_balance', 'credit_type'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
