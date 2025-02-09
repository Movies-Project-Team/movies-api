<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ChangePassworUserRequest;
use App\Http\Requests\VerifyPasswordUserRequest;
use App\Services\CommonService;
use App\Support\Constants;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request){
        
        try {

            $data = $request->all();

            $data['password'] = Hash::make($data['password']);
            $data['permission'] = Constants::PERMISSION_ADULT;

            $user = CommonService::getModel('User')->create($data);
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponseApi(['data' => $user, 'code' => 200, 'token' => $token]);
        } catch (\Exception $e) {

            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
        
    }

    public function login(AuthRequest $request){

        try {
            $data = $request->all();

            $user = CommonService::getModel('User')->getDetailByEmail($data['email']);

            if (!$user || !Hash::check($data['password'], $user->password)) {

                return $this->sendResponseApi(['message' => 'The provided credentials are incorrect.', 'code' => 401]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponseApi(['data' => $user, 'code' => 200, 'token' => $token]);
        } catch (\Exception $e) {

            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
        
    }

    /**
     * Change Password User
     */
    public function changePasswordUser(ChangePassworUserRequest $request)
    {
        try {
            
            $user = CommonService::getModel('User')->getDetail($request['userId']);

            if (!$user) {
                return $this->sendResponseApi(['message' => 'User not found', 'code' => 404]);
            }

            if (!Hash::check($request['old_password'], $user->password)) {
                return $this->sendResponseApi(['message' => 'Old password is incorrect', 'code' => 400]);
            }

            // update password
            $user->update([
               'password' => Hash::make($request['new_password']),
            ]);

            return $this->sendResponseApi(['message' => 'Password updated successfully', 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }

    /**
     * Verify Password User
     */
    public function verifyPasswordUser(VerifyPasswordUserRequest $request)
    {
        try {
            $user = CommonService::getModel('User')->getDetail($request['userId']);

            if (!$user) {
                return $this->sendResponseApi(['message' => 'User not found', 'code' => 404]);
            }

            return $this->sendResponseApi(['message' => 'Password is correct', 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }
}
