<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StudentRegisterRequest;
use App\Http\Resources\StudentResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentRegisterController extends Controller
{
    public function register(StudentRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);
        $studentProfile = $user->studentProfile()->create([
            'university' => $request->university,
            'academic_major' => $request->academic_major,
        ]);

        $token = $user->createToken('student-token')->plainTextToken;
        return response()->json([
            'message' => 'تم إنشاء الحساب بنجاح',
            'student' => new StudentResource($user),
            'token' => $token
        ], 201);
    }
}
