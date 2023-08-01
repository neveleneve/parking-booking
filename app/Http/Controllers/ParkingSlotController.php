<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function slotStatus($id, Request $request)
    {
        $slot = Slot::find($id);
        if ($request->token == $slot->token) {
            return response()->json([
                'message' => 'Data received successfully',
                'data' => $slot,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Data failed to receive',
                'data' => null,
            ], 500);
        }
    }
}
