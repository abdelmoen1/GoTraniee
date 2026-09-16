<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OrganizationRegisterRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\OrganizationProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrganizationRegisterController extends Controller
{
    public function register(OrganizationRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'organization',
        ]);

        $organizationProfile = OrganizationProfile::create([
            'user_id' => $user->id,
            'organization_name' => $request->organization_name,
            'organization_type' => $request->organization_type,
            'organization_description' => $request->description,
        ]);

        $token = $user->createToken('organization-token')->plainTextToken;

        return response()->json([
            'message' => 'تم إنشاء حساب المؤسسة بنجاح',
            'organization' => new OrganizationResource($user),
            'token' => $token,
        ], 201);
    }
}
