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
        'payment_id', 'meta_key', 'meta_value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment() {
        return $this->belongsTo('App\Payment');
    }
}
