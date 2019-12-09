<?php


namespace App;


use App\Utils\NumberUtils;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'session_id';
    }

    /**
     * @return string
     */
    public function formatToSend() {
        return NumberUtils::format($this->to_send / pow(10, 3), 3) . ' ' . strtoupper($this->crypto);
    }

}