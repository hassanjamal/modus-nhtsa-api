<?php

namespace App\NHTSA;


use GuzzleHttp\Client;

/**
 */
class BaseService
{
    protected $apiClient;

    protected $vehicleYearMakeModelUri;

    /**
     * @param Client $apiClient
     */
    public function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->vehicleYearMakeModelUri = '';
    }

    public function setVehicleYearMakeModelUrl($modelYear, $manufacturer, $model)
    {
        $this->vehicleYearMakeModelUri = config('nhtsa.api_base_url').'SafetyRatings/modelyear/' . $modelYear . '/make/' . $manufacturer . '/model/' . $model;
    }

}