<?php

namespace KirilCvetkov\TeslaApi;

use DOMDocument;
use GuzzleHttp\Client;

class TeslaApi
{
    public function connect(string $username, string $password)
    {
        $codeVerifier = $this->generateRandomString(86);
        $codeChallenge = urlencode(base64_encode(hash('sha256', $codeVerifier)));
        $state = $this->generateRandomString();

        $response = (new Client())->request('GET', 'https://auth.tesla.com/oauth2/v3/authorize', [
            'query' => [
                'client_id' => 'ownerapi',
                'code_challenge' => $codeChallenge,
                'code_challenge_method' => 'S256',
                'redirect_uri' => 'https://auth.tesla.com/void/callback',
                'response_type' => 'code',
                'scope' => 'openid email offline_access',
                'state' => $state,
                'login_hint' => $username,
            ],
        ]);

        $cookies = [];

        foreach ($response->getHeader('set-cookie') as $cookie) {
            $cookies[] = substr($cookie, 0, strpos($cookie, ';'));
        }

        if ($response->getStatusCode() !== 200) {
            return;
        }

        $dom = new DOMDocument();
        $dom->loadHTML((string) $response->getBody());

        $hiddenInputs = [];

        foreach ($dom->getElementsByTagName('input') as $input) {
            if ($input->getAttribute('type') !== 'hidden' || $input->getAttribute('name') === 'cancel') {
                continue;
            }

            $hiddenInputs[$input->getAttribute('name')] = $input->getAttribute('value');
        }

        $response = (new Client())->request('POST', 'https://auth.tesla.com/oauth2/v3/authorize', [
            'headers' => ['Cookie' => implode('; ', $cookies)],
            'query' => [
                'client_id' => 'ownerapi',
                'code_challenge' => $codeChallenge,
                'code_challenge_method' => 'S256',
                'redirect_uri' => 'https://auth.tesla.com/void/callback',
                'response_type' => 'code',
                'scope' => 'openid email offline_access',
                'state' => $state,
            ],
            'form_params' =>
                $hiddenInputs +
                [
                    'identity' => $username,
                    'credential' => $password,
                ],
        ]);
    }

    public function generateRandomString(int $length = 10)
    {
        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }
}
