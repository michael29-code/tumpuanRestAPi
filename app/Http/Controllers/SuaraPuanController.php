<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuaraPuanCreateRequest;
use App\Http\Requests\SuaraPuanUpdateRequest;
use App\Http\Resources\KategoriSuaraPuanResource;
use App\Http\Resources\SuaraPuanResource;
use App\Models\KategoriSuaraPuan;
use App\Models\SuaraPuan;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuaraPuanController extends Controller
{
    public function create(SuaraPuanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $suarapuan = new SuaraPuan($data);
        $suarapuan->user_id = $user->id;
        $suarapuan->save();

        return (new SuaraPuanResource($suarapuan))->response()->setStatusCode(201);
    }

    public function get(int $id): SuaraPuanResource
    {
        $user = Auth::user();

        $suarapuan = SuaraPuan::where('id', $id)->where('user_id', $user->id)->first();
        if (!$suarapuan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new SuaraPuanResource($suarapuan);
    }

}
