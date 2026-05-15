<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;

class BlacklistController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone_number' => 'required|unique:blacklists|regex:/^92[0-9]{10}$/'
        ]);

        Blacklist::create(['phone_number' => $request->phone_number]);

        return response()->json([
            'success' => true,
            'message' => 'Phone number added to blacklist'
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|exists:blacklists,phone_number'
        ]);

        Blacklist::where('phone_number', $request->phone_number)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Phone number removed from blacklist'
        ]);
    }
}

