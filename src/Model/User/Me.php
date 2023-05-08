<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model\User;

use KirilCvetkov\TeslaApi\Model\AbstractApiResponse;

final class Me extends AbstractApiResponse
{
    public readonly string $email;
    public readonly string $fullName;
    public readonly string $profileImageUrl;

    public static function create(array $data): self
    {
        $model = new self();
        $model->email = $data['response']['email'];
        $model->fullName = $data['response']['full_name'];
        $model->profileImageUrl = $data['response']['profile_image_url'];

        return $model;
    }
}
