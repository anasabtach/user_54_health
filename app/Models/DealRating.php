<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealRating extends Model
{
    use HasFactory;

    protected $table = 'deal_ratings';

    protected $fillable = ['user_id', 'deal_id',  'rating', 'comment', 'parent_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deal(){
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }

    public function replies(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
