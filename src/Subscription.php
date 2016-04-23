<?php

namespace Guilhermecvm\Pagarme;

use Guilhermecvm\Pagarme\Exceptions\RequestException;

class Subscription
{
    const ENDPOINT_CREATE = Pagarme::API . '/subscriptions';
    const ENDPOINT_CANCEL = Pagarme::API . '/subscriptions/{id}/cancel';

    public static function create($api_key, $plan_id, $customer_email, $payment_method, $card_hash)
    {
        $url = self::ENDPOINT_CREATE;

        $data = [
            'api_key' => $api_key,
            'plan_id' => $plan_id,
            'customer[email]' => $customer_email,
            'payment_method' => $payment_method,
        ];

        if ($card_hash) {
            $data['card_hash'] = $card_hash;
        }

        return RestClient::request('POST', $url, [
            'form_params' => $data
        ]);
    }

    public static function cancel($api_key, $subscription_id)
    {
        $url = str_replace('{id}', $subscription_id, self::ENDPOINT_CANCEL);

        return RestClient::request('POST', $url, [
            'form_params' => [
                'api_key' => $api_key
            ]
        ]);
    }

}
