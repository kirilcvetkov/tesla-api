<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class Authenticate
{
    public function getLoginUrl()
    {
        return 'https://auth.tesla.com/oauth2/v3/authorize?' .
            http_build_query([
                'client_id' => 'ownerapi',
                'code_challenge_method' => 'S256',
                'redirect_uri' => 'https://auth.tesla.com/void/callback',
                'locale' => 'en',
                'prompt' => 'login',
                'response_type' => 'code',
                'scope' => 'email',
                'state' => $this->generateRandomString(12),
            ]);
    }

    public function getToken(string $code)
    {
        $response = (new Client())->request('POST', 'https://auth.tesla.com/oauth2/v3/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'ownerapi',
                'code' => $code,
                'code_verifier' => $this->generateRandomString(86),
                'redirect_uri' => 'https://auth.tesla.com/void/callback',
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        return $body['access_token'];
    }

    public function generateRandomString(int $length = 10)
    {
        $x = implode('', array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')));

        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }

    // public function connect(string $username, string $password)
    // {
    //     $codeVerifier = $this->generateRandomString(86);
    //     $sha256Hash = hash('sha256', $codeVerifier, true);
    //     $codeChallenge = rtrim(strtr(base64_encode($sha256Hash), '+/', '-_'), '=');
    //     $state = $this->generateRandomString(12);

    //     $response = (new Client())->request('GET', 'https://auth.tesla.com/oauth2/v3/authorize', [
    //         'query' => [
    //             'client_id' => 'ownerapi',
    //             'code_challenge' => $codeChallenge,
    //             'code_challenge_method' => 'S256',
    //             'redirect_uri' => 'https://auth.tesla.com/void/callback',
    //             'response_type' => 'code',
    //             'scope' => 'openid email offline_access',
    //             'state' => $state,
    //             'login_hint' => $username,
    //         ],
    //     ]);

    //     $headerSetCookies = $response->getHeader('Set-Cookie');

    //     $cookies = [];
    //     foreach ($headerSetCookies as $key => $header) {
    //         $cookie = SetCookie::fromString($header);
    //         $cookie->setDomain('.tesla.com');

    //         $cookies[] = $cookie;
    //     }

    //     $cookieJar = new CookieJar(false, $cookies);

    //     $dom = new DOMDocument();
    //     $dom->loadHTML((string) $response->getBody());

    //     $hiddenInputs = [];

    //     foreach ($dom->getElementsByTagName('input') as $input) {
    //         $hiddenInputs[$input->getAttribute('name')] = $input->getAttribute('value');
    //     }

    //     $response = (new Client())->request('POST', 'https://auth.tesla.com/oauth2/v3/authorize', [
    //         'http_errors' => false,
    //         'cookies' => $cookieJar,
    //         'query' => [
    //             'client_id' => 'ownerapi',
    //             'code_challenge' => $codeChallenge,
    //             'code_challenge_method' => 'S256',
    //             'redirect_uri' => 'https://auth.tesla.com/void/callback',
    //             'response_type' => 'code',
    //             'scope' => 'openid email offline_access',
    //             'state' => $state,
    //         ],
    //         'form_params' =>
    //             $hiddenInputs +
    //             [
    //                 'identity' => $username,
    //                 'credential' => $password,
    //             ],
    //     ]);

    //     dd($response->getStatusCode(), (string) $response->getBody(), $response->getHeaders());
    // }
}
