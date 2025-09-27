<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use JWTAuth;
use Hash;
use DB;
use Log;

class AuthController extends Controller
{

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['user'] =  $user;

        return $this->sendResponse($success, 'User register successfully.');
    }



    public function login(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {

            $user = User::where('role_type', 1)->where('email', $request->email)->first();

            if (!$user) {
                return response()->error('Unauthorized');
            }

            $credentials = request(['email', 'password']);
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->error('Unauthorized');
            }

            return response()->success($this->respondWithToken($token));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errorx Admin Login: ' . $e->getMessage(), ['exception' => $e]);
            return response()->error();
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $success = auth()->user();

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth('api')->logout();
            return response()->success([], 'Successfully logged out.');
        } catch (\Exception $e) {
            Log::error('Error Admin Logout: ' . $e->getMessage(), ['exception' => $e]);
            return response()->error('Failed to logout. ' . $e->getMessage());
        }
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }


    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'old_password' => 'required_with:password|min:6',
            'password' => 'sometimes|required|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $user = auth()->user();
    
            if ($request->has('password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The old password is incorrect.'
                    ], 422);
                }
                $user->password = bcrypt($request->password);
            }
    
            if ($request->has('name')) {
                $user->name = $request->name;
            }
    
            $user->save();
    
            return response()->success();
        } catch (\Exception $e) {
            Log::error('Error Admin Update Profile: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile.'
            ], 500);
        }
    }
    public function getProfile()
{
    try {
        // Get the authenticated user
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Return the user's details
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    } catch (\Exception $e) {
        Log::error('Error Fetching Admin Profile: ' . $e->getMessage(), ['exception' => $e]);
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch profile.'
        ], 500);
    }
}

}
