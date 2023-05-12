<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model;

class Vehicle extends AbstractApiResponse
{
    public readonly int $id;
    public readonly int $userId;
    public readonly int $vehicleId;
    public readonly string $vin;
    public readonly string $displayName;
    public readonly string $color;
    public readonly array $tokens;
    public readonly string $state;
    public readonly bool $inService;
    public readonly string $idS;
    public readonly bool $calendarEnabled;
    public readonly int $apiVersion;
    public readonly string $backseatToken;
    public readonly string $backseatTokenUpdatedAt;

    public static function create(array $data): self
    {
        $data = $data['response'] ?? [];

        $model = new self();
        $model->id = $data['id'] ?? 0;
        $model->userId = $data['user_id'] ?? 0;
        $model->vehicleId = $data['vehicle_id'] ?? 0;
        $model->vin = $data['vin'] ?? '';
        $model->displayName = $data['display_name'] ?? '';
        $model->color = $data['color'] ?? '';
        $model->tokens = $data['tokens'] ?? [];
        $model->state = $data['state'] ?? '';
        $model->inService = $data['in_service'] ?? false;
        $model->idS = $data['id_s'] ?? '';
        $model->calendarEnabled = $data['calendar_enabled'] ?? false;
        $model->apiVersion = $data['api_version'] ?? 0;
        $model->backseatToken = $data['backseat_token'] ?? '';
        $model->backseatTokenUpdatedAt = $data['backseat_token_updated_at'] ?? '';

        return $model;
    }
}
