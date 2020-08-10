<?php


namespace App\Utils;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerUtils
{

    /**
     * @param Request $request
     * @param $validations
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(Request $request, $validations) {
        $attributesKeys = array_keys($validations);
        $attributes = array();
        foreach ($attributesKeys as $attr) {
            $attributes[$attr] = $attr;
        }

        return Validator::make($request->all(), $validations, [], $attributes);
    }

}
