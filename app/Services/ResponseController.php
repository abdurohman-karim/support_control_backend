<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ResponseController
{
    public static function successResponse($data)
    {
        return [
            'status' => true,
            'result' => $data,
            'error' => null
        ];
    }

    public function validationError($validation):array
    {
        return [
            'status' => false,
            'error' => [
                'message' => [
                    'uz' => $validation->errors()->first(),
                    'ru' => $validation->errors()->first(),
                    'en' => $validation->errors()->first(),
                ]
            ],
            'result' => null
        ];
    }

    public static function errorResponse($message,$data = [])
    {
        if (count($data))
        return [
            'status' => false,
            'error' => [
                'message' => $message
            ],
            'result' => null
        ];
        else
            return [
                'status' => false,
                'error' => [
                    'message' => $message
                ],
                'result' => null
            ];

    }

    public static function authFailed()
    {
        return [
            'status' => false,
            'error' => [
                'message' => [
                    'uz' => 'Avtorizatsiyada xatolik!',
                    'ru' => "Авторизация не удалась!",
                    'en' => "Authorization failed!"
                ]
            ],
            'result' => null
        ];
    }

    public function errorMethodUndefined($method = '')
    {
        return [
            'status' => false,
            'error' => [
                'message' => [
                    'uz' => $method.' metodi topilmadi!',
                    'ru' => 'Метод '.$method.' не найден!',
                    'en' => 'Method '.$method.' not found!',
                ]
            ],
            'result' => null
        ];
    }

    /**
     * @param array $response
     * @return array|string
     */

    public function validate(array $params, array $rules)
    {
        // Set the desired languages for error messages
        $languages = ['uz','en','ru'];

        $errors = [];

        foreach ($languages as $lang) {
            App::setLocale($lang);
            $validator = Validator::make($params, $rules);
            if ($validator->fails()) {
                $errors[$lang] = $validator->errors()->first();
            }
        }

        if (!empty($errors)) {
            return self::errorResponse($errors);
        }
        return true;
    }
}
