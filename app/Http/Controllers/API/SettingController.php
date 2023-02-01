<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Reference;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function update(SettingRequest $request)
    {
        //get references expression by value data
        $get_expression_references = Reference::where('id', $request->value)->first();
        $update = Setting::where('key', $request->key)->update([
            'key'          => $request->key,
            'value'        => $request->value,
            'expression'   => $get_expression_references->expression,
        ]);

        if ($update) {
            return response()->json([
                'success' => true,
                'message' => 'Success Update Settings Data!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Update Settings Data!',
            ], 401);
        }
    }
}
