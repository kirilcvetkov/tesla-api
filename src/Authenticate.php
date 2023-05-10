<?php

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Hydrator\Hydrator;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\Token;

class Authenticate extends HttpApi
{
    public const BASE_URL = 'https://auth.tesla.com';

    public static function create($httpClient = null, Hydrator $hydrator = null): self
    {
        return new self(
            $httpClient ?? new HttpClient(endpoint: self::BASE_URL),
            $hydrator ?? new ModelHydrator(),
        );
    }

    public function getLoginUrl(): string
    {
        return self::BASE_URL . '/oauth2/v3/authorize?' .
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
        $parameters = [
            'grant_type' => 'authorization_code',
            'client_id' => 'ownerapi',
            'code' => $code,
            'code_verifier' => $this->generateRandomString(86),
            'redirect_uri' => 'https://auth.tesla.com/void/callback',
        ];

        $response = $this->httpPost('/oauth2/v3/token', $parameters);

        return $this->hydrateResponse($response, Token::class);
    }

    public function generateRandomString(int $length = 10)
    {
        $x = implode('', array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')));

        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }
}
