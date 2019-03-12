<?php

namespace App\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function getVehicleVariants($modelYear, $manufacturer, $model)
    {
        return response()->json([], 200);
    }
}
