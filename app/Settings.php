<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $table = 'settings';

    /**
     * @param $type
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($type, $key, $default = null) {
        $value = Settings::query()
            ->where('type', $type)
            ->where('meta_key', $key)
            ->first();

        if ($value) {
            return $value->meta_value;
        }

        return $default;

    }
}