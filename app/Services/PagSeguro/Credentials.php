<?php
namespace App\Services\PagSeguro;


class Credentials
{
    public static function getCredentials($uri)
    {
        $email = config('pagseguro.email');
        $token = config('pagseguro.token');
        $env   = config('pagseguro.env');

        $urlBase = $env == 'sandbox' ? 'https://ws.sandbox.pagseguro.uol.com.br' . $uri
                                     : 'https://ws.pagseguro.uol.com.br' . $uri;

        return "$urlBase?email={$email}&token={$token}";
    }
}
