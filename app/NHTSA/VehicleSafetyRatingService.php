<?php

namespace App\NHTSA;


class VehicleSafetyRatingService extends BaseService
{
    public function getVehicleVariants($modelYear, $manufacturer, $model) {
        $data = [
            'Count' => 0,
            'Results' => []
        ];
        return $data;
    }
}