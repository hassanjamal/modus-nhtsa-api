<?php

namespace App\NHTSA;


use Illuminate\Support\Facades\Log;

class VehicleSafetyRatingService extends BaseService
{
    private const NOT_RATED_VALUE_FOR_A_VEHICLE_ID = 'Not Rated';

    /**
     * @param $modelYear
     * @param $manufacturer
     * @param $model
     * @param bool $withRating
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVehicleVariants($modelYear, $manufacturer, $model, $withRating = false)
    {
        $data = [
            'Count' => 0,
            'Results' => []
        ];
        $this->setVehicleYearMakeModelUrl($modelYear, $manufacturer, $model);

        try {
            $apiResponse = $this->apiClient->request('GET', $this->vehicleYearMakeModelUri, [
                'query' => ['format' => 'json']
            ]);
            if ($apiResponse->getStatusCode() === 200) {
                $apiData = collect(json_decode($apiResponse->getBody()));

                $results = collect($apiData['Results'])->map(function ($item) use ($data , $withRating) {
                    $vehicle = [];
                    if($withRating || $withRating === 'true'){
                        $vehicle['CrashRating'] = $this->getRatingByVehicleId($item->VehicleId);
                    }
                    $vehicle['Description'] = $item->VehicleDescription;
                    $vehicle['VehicleId'] = $item->VehicleId;
                    return $vehicle;
                });
                $data['Count'] = $results->count();
                $data['Results'] = $results->toArray();
            }
        } catch (\Exception $e) {
            Log::error('Whoops !! NHTSA API Call Error ' . $e->getMessage());
        }
        return $data;
    }

    /**
     * @param $modelYear
     * @param $manufacturer
     * @param $model
     * @param bool $withRating
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVehicleVariantsWithRatings($modelYear, $manufacturer, $model, $withRating = false)
    {
        return $this->getVehicleVariants($modelYear, $manufacturer, $model, $withRating);
    }

    /**
     * @param $vehicleId
     * @return string
     */
    protected function getRatingByVehicleId($vehicleId)
    {
        $this->setVehicleRatingUri($vehicleId);
        try {
            $apiResponse = $this->apiClient->get($this->vehicleRatingUri, [
                'query' => ['format' => 'json']
            ]);

            if ($apiResponse->getStatusCode() === 200) {
                $apiData = collect(json_decode($apiResponse->getBody()));

                if ($apiData['Count'] > 0 && collect($apiData['Results'])->count() > 0) {
                    return (string) ($apiData['Results'])[0]->OverallRating;
                }
            }
        } catch (\Exception $e) {
            Log::error('Whoops !! NHTSA API Call Error ' . $e->getMessage());
        }

        return self::NOT_RATED_VALUE_FOR_A_VEHICLE_ID;
    }

}