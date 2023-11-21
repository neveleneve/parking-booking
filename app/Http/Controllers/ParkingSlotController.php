<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller {
    public function slotStatus($id, Request $request) {
        $slot = Slot::find($id);
        if (isset($request->token)) {
            if ($request->token == $slot->token) {
                return response()->json([
                    'message' => 'Data received successfully',
                    'data' => (int) $slot->status_pakai,
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

    public function slotUpdate(Request $request) {
        //
    }
}
