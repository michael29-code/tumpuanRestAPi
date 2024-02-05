<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanHaidCreateRequest;
use App\Http\Requests\CatatanHaidUpdateRequest;
use App\Http\Resources\CatatanHaidResource;
use App\Models\CatatanHaid;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanHaidController extends Controller
{
    public function create(CatatanHaidCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $catatanhaid = new CatatanHaid($data);
        $catatanhaid->user_id = $user->id;
        $catatanhaid->save();

        return (new CatatanHaidResource($catatanhaid))->response()->setStatusCode(201);
    }

    public function get(): CatatanHaidResource
    {
        $user = Auth::user();
        $catatanhaid = CatatanHaid::where('user_id', $user->id)->first();
        if (!$catatanhaid) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new CatatanHaidResource($catatanhaid);
    }

    public function update(CatatanHaidUpdateRequest $request): CatatanHaidResource
    {
        $user = Auth::user();
        $catatanhaid = CatatanHaid::where('user_id', $user->id)->first();
        if (!$catatanhaid) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $catatanhaid->fill($data);
        $catatanhaid->save();

        return new CatatanHaidResource($catatanhaid);
    }

    public function delete(): JsonResponse
    {
        $user = Auth::user();
        $catatanhaid = CatatanHaid::where('user_id', $user->id)->first();
        if (!$catatanhaid) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "unauthorized"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $catatanhaid->delete();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);

    }
}
