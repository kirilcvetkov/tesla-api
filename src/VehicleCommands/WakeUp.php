<?php

namespace KirilCvetkov\TeslaApi;

class WakeUp extends HttpApi
{
    /**
     * Returns a single vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function send(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/wake_up', $id));

        return $this->hydrateResponse($response, '');
    }
}
