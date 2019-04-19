<?php

namespace App\NHTSA;

use GuzzleHttp\Client;

/**
 */
class BaseService
{
    protected $apiClient;

    protected $vehicleYearMakeModelUri;
    protected $vehicleRatingUri;

    /**
     * @param Client $apiClient
     */
    public function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->vehicleYearMakeModelUri = '';
        $this->vehicleRatingUri = '';
    }

    public function setVehicleYearMakeModelUrl($modelYear, $manufacturer, $model)
    {
        $this->vehicleYearMakeModelUri = config('nhtsa.api_base_url') . 'SafetyRatings/modelyear/' . $modelYear . '/make/' . $manufacturer . '/model/' . $model;
    }

    public function setVehicleRatingUri($vehicleId)
    {
        $this->vehicleRatingUri = config('nhtsa.api_base_url') . 'SafetyRatings/VehicleId/' . $vehicleId;
    }
}
