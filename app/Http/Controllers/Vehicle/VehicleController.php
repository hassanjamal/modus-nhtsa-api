<?php

namespace App\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NHTSA\VehicleSafetyRatingService;
use Illuminate\Support\Facades\Validator;

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
        return response()->json($this->vehicleSafetyRatingService->getVehicleVariants($modelYear, $manufacturer, $model));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postVehicle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modelYear' => ['required', 'regex:/^(19|20)\d{2}$/'],
            'manufacturer' => 'required',
            'model' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Count' => 0,
                'Results' => []
            ]);
        }

        return response()->json($this->vehicleSafetyRatingService->getVehicleVariants($request->modelYear, $request->manufacturer, $request->model));
    }
}
