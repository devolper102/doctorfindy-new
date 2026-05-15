<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FriendAndFamily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FriendAndFamilyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Fetch user's Friend and Family
     *
     * @param int $user_id 
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id){
        $friendsAndFamily = FriendAndFamily::where('user_id', $user_id)->get();
        return response()->json([
                    "friendsAndFamily" => $friendsAndFamily,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Add user's Friend or Family
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string|size:11',
            'relation' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Create a new friend or family record
        $friendAndFamily = new FriendAndFamily([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'relation' => $request->input('relation'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
        ]);

        // Associate with the authenticated user
        $user->friendsAndFamily()->save($friendAndFamily);

        return response()->json(['message' => 'Friend or family member added successfully', 'friendAndFamily' => $friendAndFamily]);
    }
}
