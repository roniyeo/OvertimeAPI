<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OvertimeCalculateRequest;
use App\Http\Requests\OvertimeGetRequest;
use App\Http\Requests\OvertimeRequest;
use App\Http\Resources\OvertimeCalculateResource;
use App\Http\Resources\OvertimeResource;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function post(OvertimeRequest $request)
    {
        $overtime = Overtime::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'time_started' => $request->time_started,
            'time_ended' => $request->time_ended,
         ]);

        if ($overtime) {
            return response()->json([
                'success' => true,
                'message' => 'Success Add Overtime Data!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Add Overtime Data!',
            ], 401);
        }
    }

    public function get(OvertimeGetRequest $request)
    {
        $overtime = Overtime::whereBetween('date', [$request->date_started, $request->date_ended])->get();
        if ($overtime) {
            return OvertimeResource::collection($overtime);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Retrieve Overtime Data!',
            ], 401);
        }
    }

    public function calculate(OvertimeCalculateRequest $request)
    {
        $date = Carbon::createFromFormat('Y-m', $request->month);
        $monthName = $date->format('m');
        
        //search overtime where month
        $overtime = Overtime::whereMonth('date', $monthName)->get();
        
        return OvertimeCalculateResource::collection($overtime);
    }

}
