<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;
use Psr\Http\Client\ClientExceptionInterface;

class Controls extends HttpApi
{
    /**
     * Sends a Wake Up command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function wakeup(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/wake_up', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends a Honk Horn command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function honkHorn(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/honk_horn', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends a Set Sunroof Position command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param ?string $state Sunroof state: open - 100% | closed - 0% | comfort - 80% | vent - 15% | move - specify percent
     * @param ?int $percent Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function setSunroof(int $id, string $state, ?int $percent = null)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');
        Assert::regex($state, '/open|closed|comfort|vent|move/', 'State allows only open, closed, comfort, or vent.');

        $percent = match ($state) {
            'open' => 100,
            'closed' => 0,
            'comfort' => 80,
            'vent' => 15,
            'move' => $percent ?? 0,
        };

        $response = $this->httpPost(sprintf(
            'https://owner-api.teslamotors.com/api/1/vehicles/%d/command/sun_roof_control?state=%s&percent=%d',
            $id,
            $state,
            $percent,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Actuate Trunk command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function actuateTrunk(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/actuate_trunk', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Remote Start Drive command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param string $password Account password
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function remoteStartDrive(int $id, string $password)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            '/api/1/vehicles/%d/command/remote_start_drive?password=%s',
            $id,
            $password,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Set Valet Mode command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param string $password Account password
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function setValetMode(int $id, string $on, string $password)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            '/api/1/vehicles/%d/command/set_valet_mode?on=%s&password=%s',
            $id,
            $on,
            $password,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Set Valet Mode command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param string $password Account password
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function resetValetPin(int $id, string $on, string $password)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            '/api/1/vehicles/%d/command/set_valet_mode?on=%s&password=%s',
            $id,
            $on,
            $password,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
