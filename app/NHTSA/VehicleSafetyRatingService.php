<?php

namespace App\NHTSA;


use Illuminate\Support\Facades\Log;

class VehicleSafetyRatingService extends BaseService
{


    public function getVehicleVariants($modelYear, $manufacturer, $model)
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

                $results = collect($apiData['Results'])->map(function ($item) use ($data) {
                    $vehicle = [
                        'Description' => $item->VehicleDescription,
                        'VehicleId' => $item->VehicleId,
                    ];
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
}