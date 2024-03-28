<?php

if (!function_exists('is_forbidden')) {
    function is_forbidden(string $permission):void
    {
        if (env("PERMISSION_WRITE",false))
        {
            if (\Spatie\Permission\Models\Permission::where('name',$permission)->exists() == null)
                \Spatie\Permission\Models\Permission::updateOrCreate([
                    'name' => $permission
                ]);
        }
        if (!auth()->user()->can($permission))
            abort(403,"Ushbu metoddan foydalanish xuquqiga ega emassiz! Ruxsat: $permission");
    }
}

if (!function_exists('is_user_can')) {
    function is_user_can(string $permission)
    {
        if (env("PERMISSION_WRITE",false))
        {
            if (\Spatie\Permission\Models\Permission::where('name',$permission)->exists() == null)
                \Spatie\Permission\Models\Permission::updateOrCreate([
                    'name' => $permission
                ]);
        }
        return auth()->user()->can($permission);
    }
}

if (!function_exists('nf')) {
    function nf($number)
    {
        return number_format($number, 0, "", " ");
    }
}

if (!function_exists('dateFormatted')) {
    function dateFormatted($date)
    {
        return date("d.m.Y - H:i",strtotime($date));
    }
}


if (!function_exists('nfComma')) {
    function nfComma($number)
    {
        $decimalPosition = strpos($number, ".");
        $count = $decimalPosition !== false ? strlen(substr($number, $decimalPosition + 1)) : 0;
        return number_format($number, $count, ".", ",");
    }
}

if (!function_exists('removeChars')) {
    function removeChars($value)
    {
        return str_replace(array('\'', '"', ',', ';', '.', '’','-','‘','/','+',')','(',' '), "", $value);
    }
}

if (!function_exists('toFloat')) {
    function toFloat($number):float
    {
        return (float)number_format($number, 2);
    }
}

if (!function_exists('phone_formatting'))
{
    function phone_formatting($phone)
    {
        $phone = preg_replace("/[^0-9]/", '', $phone);
        return "+998".substr($phone,-9);
    }
}

if (!function_exists('getRate'))
{
    function getRate()
    {
        return nfComma(cache('constants')['rate'] ?? 0);
    }
}

if (!function_exists('getRateFloat'))
{
    function getRateFloat()
    {
        return cache('constants')['rate'] ?? 0;
    }
}

if (!function_exists('phone_show_formatting'))
{
    function phone_show_formatting($phone)
    {
        $phoneNumber = substr(preg_replace("/[^0-9]/", '', $phone),-9);
        return sprintf("(%s) %s-%s-%s",
            substr($phoneNumber, 0, 2),
            substr($phoneNumber, 2, 3),
            substr($phoneNumber, 5, 2),
            substr($phoneNumber, 7, 2)
        );
    }
}

if (!function_exists('sendByTelegram'))
{
    function sendByTelegram($message,$chatID = null)
    {
        if (!is_null($chatID) && strlen($chatID) > 5)
            \App\Jobs\SendTgMessage::dispatch($message,$chatID);
        else
            \App\Services\LogWriter::sendByTelegram($message,$chatID);
        return 1;
    }
}

if (!function_exists('getPaymentType'))
{
    function getPaymentType():string
    {
        return \Illuminate\Support\Facades\Cache::get("payment_type_".auth()->id()) ?? 'card';
    }
}

if (!function_exists('setPaymentType'))
{
    function setPaymentType($type = 'card'):void
    {
        \Illuminate\Support\Facades\Cache::put("payment_type_".auth()->id(),$type,108000);
    }
}

if (!function_exists('message_set'))
{
    function message_set($message,$type,$title = '',$timer = 60)
    {
        session()->put('_message',$message);
        session()->put('_description',$title);
        session()->put('_type',$type);
        session()->put('_timer',$timer*1000);
    }
}

if (!function_exists('message_clear'))
{
    function message_clear()
    {
        session()->pull('_description');
        session()->pull('_message');
        session()->pull('_type');
        session()->pull('_timer');
    }
}


if (!function_exists('removeSpaces')) {
    function removeSpaces($value)
    {
        return str_replace(" ", "", $value);
    }
}
