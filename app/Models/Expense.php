<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'description', 'type', 'amount',
        'photo', 'expense_date'
    ];

    protected $dates = ['expense_date'];

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / 100;
    }

    public function setAmountAttribute($prop)
    {
        $amount = str_replace(['.', ','], ['', '.'], $prop); //19,90 -> 19.90 | 1.090,99 -> 1090.99

        return $this->attributes['amount'] = $amount * 100; //1990, 109099
    }

    public function setExpenseDateAttribute($prop)
    {
        return $this->attributes['expense_date'] = (\DateTime::createFromFormat('d/m/Y H:i:s', $prop))->format('Y-m-d H:i:s');
    }

    public function getCategoriesArrAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
