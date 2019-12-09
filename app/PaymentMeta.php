<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class PaymentMeta extends Model
{

    protected $table = 'payment_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_key', 'meta_value'
    ];

    public function user() {
        return $this->belongsTo('App\Payment');
    }
}