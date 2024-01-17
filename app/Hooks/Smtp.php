<?php

namespace App\Hooks;

use App\Services\Gsheets;
use App\Services\MailService;
use Themosis\Hook\Hookable;
use ReCaptcha\ReCaptcha;
use GuzzleHttp\Client;
use Ajax;
use DB;
use Request;
use Validator;

class Smtp extends Hookable
{
    public function register()
    {
        Ajax::listen('smtp', function () {                       
            $response = new \stdClass();
            $titleSuccess = 'Exito';
            $titleFailed = 'Error';
            $messageFailed = 'Ha ocurrido un problema';
            $messageSuccess = 200;
            $validator = Validator(Request::all(), [
                "smtp_host" => 'required|string',
                "smtp_port" => 'required|string',
                "wSmtperCheckSecured" => 'required|string',                          
                "wSmtperCheckAuthentication" => 'required|string',            
                "smtp_login" => 'required|string',
                "smtp_pass" =>'required|string' ,       
                "email_from" => 'required|email',
                "email_to" => 'required|email',
                "_token" => 'string'
            ]);
            
            if ($validator->fails()) {
                wp_send_json_error([
                    'title' => 'Error',
                    'text' => 'Error en la validación de datos',
                    'details' => $validator->errors(),
                ], 400);
                die();
            }
            $data = $validator->validated();
            if(!empty($data)){                
                $response->success = true;
                $response->message = [
                    'type' => 'success',
                    'status' => $messageSuccess,
                    'title' => $titleSuccess,
                ];
            }
           
        return wp_send_json($response); //json_encode
        die();
        });
     
    }
}