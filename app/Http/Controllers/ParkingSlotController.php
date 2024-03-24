<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParkingSlotController extends Controller {
    public function slotStatus($id, Request $request) {
        $validate = Validator::make($request->all(), [
            'token' => 'required|string|size:10'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'Data failed to receive',
                'data' => null,
                'response' => 401,
            ], 401);
        } else {
            $slot = Slot::find($id);
            if (!$slot) {
                return response()->json([
                    'message' => 'Data failed receive',
                    'data' => null,
                    'response' => 404,
                ], 404);
            } else {
                if ($request->has('token')) {
                    if ($request->token == $slot->token) {
                        return response()->json([
                            'message' => 'Data received successfully',
                            'data' => [
                                'id' => $slot->id,
                                'token' => $slot->token,
                                'status_pakai' => $slot->status_pakai,
                                'status_respon' => $slot->status_respon,
                                'status' => $slot->status,
                            ],
                            'response' => 200,
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Data failed to receive',
                            'data' => null,
                            'response' => 401,
                        ], 401);
                    }
                } else {
                    return response()->json([
                        'message' => 'Data failed to receive',
                        'data' => null,
                        'response' => 401,
                    ], 401);
                }
            }
        }
    }

    public function slotUpdate(Request $request) {
        //
    }

    public function slotStep(Request $request) {
        // 
    }
}
