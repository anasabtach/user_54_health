<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $table = 'deals';

    public function ratings(){
        return $this->hasMany(DealRating::class, 'deal_id', 'id');
    }

    // public function scopeWithTotalRatings($query){
    //     return $query->ratings()->sum('rating');
    // }

    public function scopeTotalRating(){
        return number_format($this->ratings()->whereNull('parent_id')->avg('rating'), 1);
    }

    public function scopeGetUser($query, $id, $deal_id)
    {
        return $query->whereHas('ratings', function ($q) use ($id, $deal_id) {
            $q->where('user_id', $id)->where('deal_id', $deal_id);
        });
    }

}
