<?php

namespace App\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function vehicles($modelYear, $manufacturer, $model)
    {
        return response()->json([], 200);
    }
}
