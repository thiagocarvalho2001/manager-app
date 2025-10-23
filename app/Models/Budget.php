<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['user_id', 'category_id', 'amount', 'month', 'year'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function forUser($userId)
    {
        return static::where('user_id', $userId);
    }

    public static function totalForMonth($userId, $month, $year)
    {
        return static::where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->sum('amount');
    }
}
