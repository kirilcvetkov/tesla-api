<?php

namespace KirilCvetkov\TeslaApi;

class TripPlanner extends HttpApi
{
    /**
     * Request a trip plan based on the car model, origin, destination and remaining charge.
     *
     * @return array
     * @throws ClientExceptionInterface
     */
    public function create(
        string $carTrim,
        string $carType,
        string $destination,
        string $origin,
        string $originSoe,
        string $vin,
    ) {
        $payload = [
            'car_trim' => $carTrim,
            'car_type' => $carType,
            'destination' => $destination,
            'origin' => $origin,
            'origin_soe' => $originSoe,
            'vin' => $vin,
        ];
        $response = $this->httpPost('/trip-planner/api/v1/tripplan', $payload);

        return $this->hydrateResponse($response, '');
    }
}
