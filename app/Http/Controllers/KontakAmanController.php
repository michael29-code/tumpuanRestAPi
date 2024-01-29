<?php

namespace App\Http\Controllers;

use App\Http\Requests\KontakAmanCreateRequest;
use App\Http\Requests\KontakAmanUpdateRequest;
use App\Http\Resources\KontakAmanResource;
use App\Models\KontakAman;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakAmanController extends Controller
{
    public function create(KontakAmanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $kontakaman = new KontakAman($data);
        $kontakaman->user_id = $user->id;
        $kontakaman->save();

        return (new KontakAmanResource($kontakaman))->response()->setStatusCode(201);
    }

    public function get(int $id): KontakAmanResource
    {
        $user = Auth::user();

        $contact = KontakAman::where('id', $id)->where('user_id', $user->id)->first();
        if (!$contact) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new KontakAmanResource($contact);
    }

    public function update(int $id, KontakAmanUpdateRequest $request): KontakAmanResource
    {
        $user = Auth::user();

        $kontakaman = KontakAman::where('id', $id)->where('user_id', $user->id)->first();
        if (!$kontakaman) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $kontakaman->fill($data);
        $kontakaman->save();

        return new KontakAmanResource($kontakaman);
    }

    public function delete(int $id): JsonResponse
    {
        $user = Auth::user();

        $kontakaman = KontakAman::where('id', $id)->where('user_id', $user->id)->first();
        if (!$kontakaman) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $kontakaman->delete();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }

}
