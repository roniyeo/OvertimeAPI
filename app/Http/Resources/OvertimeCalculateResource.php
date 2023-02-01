<?php

namespace App\Http\Resources;

use App\Models\Reference;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use NXP\MathExecutor;

class OvertimeCalculateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //check employee status_id
        //if employee status_id == 3, this a pegawai tetap
        if($this->employee->status_id == 3){
            $start = Carbon::parse($this->time_started);
            $end = Carbon::parse($this->time_ended);
            $overtime_duration_total = $end->diffInHours($start);
            $salary = $this->employee->salary;
        //if employee status_id == 4, this a pegawai percobaan (overtime duration -1 hour)
        }elseif($this->employee->status_id == 4) {
            $start = Carbon::parse($this->time_started);
            $end = Carbon::parse($this->time_ended);
            $hour = $end->diffInHours($start);
            $overtime_duration_total = $hour-1;
            $salary = $this->employee->salary;
        }

        //get method calculation from Settings
        $get_method_calculation = Setting::first();
        //call math execution package to handle math calculation
        $executor = new MathExecutor();
        //set variable for math executor
        $executor->setVar('salary', $salary)->setVar('overtime_duration_total', $overtime_duration_total);

        return $data = [
            'id' => $this->employee_id,
            'name' => $this->employee->name,
            'status_id' => $this->employee->status_id,
            'status' => [
                'name' => $this->employee->reference->name,
            ],
            'overtimes' => [
                'id' => $this->id,
                'date' => $this->date,
                'time_started' => $this->time_started,
                'time_ended' => $this->time_ended,
                'overtime_duration' => $overtime_duration_total,
            ],
            'overtime_duration_total' => $overtime_duration_total,
            'amount' => $executor->execute($get_method_calculation->expression),
        ];

    }

    public function with($request)
    {
        return ['status' => 'success'];
    }
}
