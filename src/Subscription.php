<?php

namespace Guilhermecvm\Pagarme;

use GuzzleHttp\Client;

class Subscription
{
    const ENDPOINT_CREATE = Pagarme::API . '/subscriptions';
    const ENDPOINT_CANCEL = Pagarme::API . '/subscriptions/{id}/cancel';

    public static function create($api_key, $plan_id, $card_hash, $customer_email)
    {
        $client = new Client();
        $url = self::ENDPOINT_CREATE;

        return $client->request('POST', $url, [
            'form_params' => [
                'api_key' => $api_key,
                'plan_id' => $plan_id,
                'card_hash' => $card_hash,
                'customer[email]' => $customer_email,
            ]
        ]);
    }

    public static function cancel($api_key, $subscription_id)
    {
        $client = new Client();
        $url = str_replace('{id}', $subscription_id, self::ENDPOINT_CANCEL);

        return $client->request('POST', $url, [
            'form_params' => [
                'api_key' => $api_key
            ]
        ]);
    }

}
