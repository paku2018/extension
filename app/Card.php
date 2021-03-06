<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;
    protected $table = 't_card_info';
    protected $primaryKey = 'id';
    protected $fillable = ['id','user_id','email','stripe_cus_id','amount','currency'];

    public function user()
    {
        return $this->hasOne('\App\User','id','user_id');
    }
}
