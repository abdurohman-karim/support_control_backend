<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class LogWriter
{
    public static function deleteActivity($object,$file='DeleteAction',$folder = 'Deletes')
    {
        $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
        $message .= "\nUser: ".json_encode(auth()->user());
        $message .= "\nObject: ".json_encode($object);
        $message .= "\n-------------------------------------------------------------";
        return self::log($message,$file,$folder);
    }

    public static function exception(\Exception $exception,$folder = null)
    {
        if (is_null($folder))
            $folder = str_replace('.','_',basename($exception->getFile()));

        $message = "Time [".date('H:i:s')."]\n";
        $message.= "\nFile-----|  ".$exception->getFile();
        $message.= "\nLine-----|  ".$exception->getLine();
        $message.= "\nMessage--|  ".$exception->getMessage();
        $message.= "\nCode-----|  ".$exception->getCode();
        $message .= "\n------------------------------------------------------------------------------------------------------------------------\n";
        return self::log($message,date('M-d'),"Exceptions/$folder");
    }

    public static function updateActivity($object,$newObject,$file='UpdateAction',$folder = 'Updates')
    {
        try {
            $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
            $message .= "\nUser: ".json_encode(auth()->user());
            $message .= "\nOld Object: ".json_encode($object);
            $message .= "\nNew Object: ".json_encode($object);
            $message .= "\n-------------------------------------------------------------";
            return self::log($message,$file,$folder);
        }catch (\Exception $exception)
        {
            return 1;
        }
    }

    public static function sendByTelegram($content,$chatId)
    {
        try {
            $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
            $message .= "\nMessage: ".$content;
            $message .= "\nChatId: ".$chatId;
            $message .= "\n-------------------------------------------------------------";
            return self::log($message,date('Y-m'),'TelegramMessageErrors');
        }catch (\Exception $exception)
        {
            return 1;
        }
    }

    public static function createUser(User $user)
    {
        try {
            $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
            $message .= "\nUser: ".json_encode(auth()->user());
            $message .= "\nCreated User: ".json_encode($user,128);
            $message .= "\nRoles: ".json_encode($user->roles,128);
            $message .= "\n-------------------------------------------------------------";
            return self::log($message,date('Y-m'),'CreateUser');
        }catch (\Exception $exception)
        {
            return 1;
        }
    }

    public static function updateUser(User $old,User $new)
    {
        try {
            $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
            $message .= "\nUser: ".json_encode(auth()->user());
            $message .= "\nOld User: ".json_encode($old,128);
            $message .= "\nNew User: ".json_encode($new,128);
            $message .= "\n-------------------------------------------------------------";
            return self::log($message,date('Y-m'),'UpdateUser');
        }catch (\Exception $exception)
        {
            return 1;
        }
    }

    public static function deleteUser(User $user)
    {
        try {
            $message = "\n[\"DateTime\"]: [".date('Y-m-d H:i:s')."]";
            $message .= "\nUser: ".json_encode(auth()->user());
            $message .= "\nDeleted User: ".json_encode($user,128);
            $message .= "\n-------------------------------------------------------------";
            return self::log($message,'DeleteUser','DeleteUser');
        }
        catch (\Exception $exception)
        {
            return 1;
        }
    }
    public static function smsSendSuccess($request, $response)
    {
        $body = json_encode($request);
        $response = json_encode($response);

        $message = "Time [".date('H:i:s')."]\n";
        $message.= "Request--|  $body\n";
        $message.= "Response-|  $response\n------------------------------------------------------------------------------------------------------------------------\n";
        return self::log($message,date('M-d'),"SMS/Send/".date('Y-m'));
    }

    public static function smsSend($request, $response)
    {
        $body = json_encode($request);
        $response = json_encode($response);

        $message = "Time [".date('H:i:s')."]\n";
        $message.= "Request--|  $body\n";
        $message.= "Response-|  $response\n------------------------------------------------------------------------------------------------------------------------\n";
        return self::log($message,date('M-d'),"SMS/Errors/Send/".date('Y-m'));
    }

    public static function smsReSend($request, $response)
    {
        $body = json_encode($request);
        $response = json_encode($response);

        $message = "Time [".date('H:i:s')."]\n";
        $message.= "Request--|  $body\n";
        $message.= "Response-|  $response\n------------------------------------------------------------------------------------------------------------------------\n";
        return self::log($message,date('M-d'),"SMS/Errors/ReSend/".date('Y-m'));
    }

    public static function requests(Request $request, $response,$execution_time = null)
    {
        $headers = json_encode($request->header());
        $body = json_encode($request->all());
        $response = json_encode($response);

        $message = "Time [".date('H:i:s')."]\n";
        $message.= "Headers--|  $headers\n";
        $message.= "Body-----|  $body\n";
        $message.= "Response-|  $response\n";
        $message.= "Execution|  $execution_time ms\n------------------------------------------------------------------------------------------------------------------------\n";
        return self::log($message,date('M-d'),"API/".date('Y-m'));
    }

    public static function login($data)
    {
        $message= json_encode($data);
        $message.= ",";
        return self::log($message,date('M-d'),"LoginControl/".date('Y-m'));
    }


    // main log writer function
    public static function log($content, $file = 'app', $dir = 'AppLogs')
    {
        self::dirChecker($dir);
        $path = storage_path("logs/".$dir."/".$file.'.log');
        return fwrite(fopen($path,'a'),$content."\n");
    }

    // check existing of directory and create if not exists
    public static function dirChecker($dir)
    {
        $directories = explode("/",$dir);
        $dir_path = storage_path("logs");

        foreach ($directories as $directory) {

            $dir_path .= "/".$directory;

            if(is_dir($dir_path) === false )
            {
                mkdir($dir_path);
            }
        }
    }


}
