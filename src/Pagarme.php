<?php

namespace Guilhermecvm\Pagarme;

abstract class Pagarme
{
    const API = 'https://api.pagar.me/1';

    public static $api_key = null;

    public static function setApiKey($api_key)
    {
        self::$api_key = $api_key;
    }

    public static function validateRequestSignature($payload, $signature)
    {
		$parts = explode('=', $signature, 2);
		return (count($parts) === 2) && (hash_hmac($parts[0], $payload, self::$api_key) === $parts[1]);
	}
}
