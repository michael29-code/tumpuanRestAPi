<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\RoleRecource;
use App\Models\Role;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function create(RoleCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data = $request->validated();
        // $user = Auth::user();

        if (Role::where('nama_role', $data['nama_role'])->count() == 1) {
            throw new HttpResponseException(response([
                "errors" => [
                    "nama_role" => [
                        "Nama role untuk puan sudah ada."
                    ]
                ]
            ], 400));
        }

        $role = new Role($data);
        // $role->user_id = $user->id;
        $role->save();

        return (new RoleRecource($role))->response()->setStatusCode(201);
    }

    public function get(int $id): RoleRecource
    {
        // $user = Auth::user();
        $role = Role::where('id', $id)->first();
        if (!$role) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new RoleRecource($role);
    }

    public function update(int $id, RoleUpdateRequest $request): RoleRecource
    {
        $user = Auth::user();

        $role = Role::where('id', $id)->first();
        if (!$role) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $role->fill($data);
        $role->save();

        return new RoleRecource($role);
    }

    public function delete(int $id): JsonResponse
    {
        $user = Auth::user();

        $role = Role::where('id', $id)->first();
        if (!$role) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $role->delete();
        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
