<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordProfileRequest;
use App\Http\Requests\GetListProfileRequest;
use App\Http\Requests\GetProfileRequest;
use App\Http\Requests\VerifyPasswordProfileRequest;
use App\Models\Profile;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileRepository;

    public function __construct(Profile $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Get List Profile by Account
     */
    public function getListProfile(GetListProfileRequest $request, $id)
    {
        //
        try {
            $profiles = $this->profileRepository->getData([
                'type' => 2,
                'where' => [
                    'user_id' => $id
                ]
            ]);

            return $this->sendResponseApi(['data' => $profiles, 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }

    /**
     * Get Profile by Account
     */
    public function getProfile(GetProfileRequest $request)
    {
        //
        try {
            $profile = $this->profileRepository->getData([
                'type' => 1,
                'id' => $request['profile_id']
            ]);

            if (!$profile) {
                return $this->sendResponseApi(['message' => 'Profile not found', 'code' => 404]);
            }

            return $this->sendResponseApi(['data' => $profile, 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }

    /**
     * Change Password Profile by Account
     */
    public function changePasswordProfile(ChangePasswordProfileRequest $request)
    {
        try {
            $profile = $this->profileRepository->getData([
                'type' => 1,
                'id' => $request['profile_id']
            ]);

            if (!$profile) {
                return $this->sendResponseApi(['message' => 'Profile not found', 'code' => 404]);
            }

            if (!Hash::check($request['old_password'], $profile->password)) {
                return $this->sendResponseApi(['message' => 'Old password is incorrect', 'code' => 400]);
            }

            $profile->password = Hash::make($request['new_password']);
            $profile->save();

            return $this->sendResponseApi(['message' => 'Password updated successfully', 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }

    }

    /**
     * Verify Password Profile by Account
     */
    public function verifyPasswordProfile(VerifyPasswordProfileRequest $request)
    {
        try {
            $profile = $this->profileRepository->getData([
                'type' => 1,
                'id' => $request['profile_id']
            ]);

            if (!$profile) {
                return $this->sendResponseApi(['message' => 'Profile not found', 'code' => 404]);
            }

            if (Hash::check($request['password'], $profile->password)) {
                return $this->sendResponseApi(['message' => 'Password is correct', 'code' => 200]);
            } else {
                return $this->sendResponseApi(['message' => 'Password is incorrect', 'code' => 400]);
            }
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }
}
