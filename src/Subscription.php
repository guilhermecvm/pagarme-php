<?php

namespace Guilhermecvm\Pagarme;

use Guilhermecvm\Pagarme\Exceptions\RequestException;

class Subscription
{
    const ENDPOINT_CREATE = Pagarme::API . '/subscriptions';
    const ENDPOINT_CANCEL = Pagarme::API . '/subscriptions/{id}/cancel';
    const ENDPOINT_UPDATE = Pagarme::API . '/subscriptions/{id}';

    public static function create($data)
    {
        $url = self::ENDPOINT_CREATE;

        $data['api_key'] = PagarMe::$api_key;

        return RestClient::request('POST', $url, [
            'form_params' => $data
        ]);
    }

    public static function cancel($subscription_id)
    {
        $url = str_replace('{id}', $subscription_id, self::ENDPOINT_CANCEL);

        $data['api_key'] = PagarMe::$api_key;

        return RestClient::request('POST', $url, [
            'form_params' => $data
        ]);
    }

    public static function update($id, $data)
    {
        $url = str_replace('{id}', $id, self::ENDPOINT_UPDATE);

        $data['api_key'] = PagarMe::$api_key;

        return RestClient::request('PUT', $url, [
            'form_params' => $data
        ]);
    }
}
