<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\NHTSA\VehicleSafetyRatingService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * @var VehicleSafetyRatingService
     */
    private $vehicleSafetyRatingService;

    /**
     * VehicleController constructor.
     * @param VehicleSafetyRatingService $vehicleSafetyRatingService
     */
    public function __construct(VehicleSafetyRatingService $vehicleSafetyRatingService)
    {
        $this->vehicleSafetyRatingService = $vehicleSafetyRatingService;
    }


    /**
     * @param $modelYear
     * @param $manufacturer
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVehicleVariants($modelYear, $manufacturer, $model)
    {
        return response()->json($this->vehicleSafetyRatingService->getVehicleVariants($modelYear ,$manufacturer, $model));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postVehicle(Request $request)
    {
        return response()->json([], 200);
    }
}
