<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParkingSlotController extends Controller {
    public function slotStatus(Request $request) {
        $validate = Validator::make($request->all(), [
            'id' => 'required|integer',
            'token' => 'required|string|size:10'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation failed!',
                'data' => null,
                'response' => 401,
            ], 401);
        } else {
            $slot = Slot::find($request->id);
            if (!$slot) {
                return response()->json([
                    'message' => 'Slot is not found!',
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
                                'status_pakai' => (int)$slot->status_pakai,
                                'status_respon' => (int)$slot->status_respon,
                                'status' => (int)$slot->status,
                            ],
                            'response' => 200,
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Token is not recognized!',
                            'data' => null,
                            'response' => 401,
                        ], 401);
                    }
                } else {
                    return response()->json([
                        'message' => 'Token is not found!',
                        'data' => null,
                        'response' => 401,
                    ], 401);
                }
            }
        }
    }

    public function slotUpdate(Request $request) {
        $validate = Validator::make($request->all(), [
            'id' => 'required|integer',
            'status_respon' => 'required|integer',
            'token' => 'required|string|size:10'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'Data failed to update',
                'data' => null,
                'response' => 401,
            ], 401);
        } else {
            $slot = Slot::find($request->id);
            if (!$slot) {
                return response()->json([
                    'message' => 'Slot is not found!',
                    'data' => null,
                    'response' => 404,
                ], 404);
            } else {
                if ($request->has('token')) {
                    if ($request->token == $slot->token) {
                        if ($request->status_respon == 3 || $request->status_respon == 4) {
                            $slot->update([
                                'status_respon' => $request->status_respon
                            ]);
                        } else {
                            return response()->json([
                                'message' => 'Response not found!',
                                'data' => null,
                                'response' => 200,
                            ], 200);
                        }
                        return response()->json([
                            'message' => 'Data updated successfully',
                            'data' => null,
                            'response' => 200,
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Token is not recognized!',
                            'data' => null,
                            'response' => 401,
                        ], 401);
                    }
                } else {
                    return response()->json([
                        'message' => 'Token is not found',
                        'data' => null,
                        'response' => 401,
                    ], 401);
                }
            }
        }
    }
}
