<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriSuaraPuanCreateRequest;
use App\Http\Requests\KategoriSuaraPuanUpdateRequest;
use App\Http\Resources\KategoriSuaraPuanResource;
use App\Models\KategoriSuaraPuan;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriSuaraPuanController extends Controller
{
    public function create(KategoriSuaraPuanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (KategoriSuaraPuan::where('nama', $data['nama'])->count() == 1) {
            throw new HttpResponseException(response([
                "errors" => [
                    "nama" => [
                        "Nama kategori suara puan sudah ada."
                    ]
                ]
            ], 400));
        }

        $kategoriSuaraPuan = new KategoriSuaraPuan($data);
        $kategoriSuaraPuan->save();

        return (new KategoriSuaraPuanResource($kategoriSuaraPuan))
            ->response()
            ->setStatusCode(201);
    }

    public function get(int $id): KategoriSuaraPuanResource
    {
        $kategoriSuaraPuan = KategoriSuaraPuan::where('id', $id)->first();
        if (!$kategoriSuaraPuan) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "Kategori suara puan tidak ditemukan."
                    ]
                ]
            ], 404));
        }

        return new KategoriSuaraPuanResource($kategoriSuaraPuan);
    }

    public function update(int $id, KategoriSuaraPuanUpdateRequest $request): KategoriSuaraPuanResource
    {
        $kategorisuarapuan = KategoriSuaraPuan::where('id', $id)->first();
        if (!$kategorisuarapuan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $kategorisuarapuan->fill($data);
        $kategorisuarapuan->save();

        return new KategoriSuaraPuanResource($kategorisuarapuan);
    }

    public function delete(int $id): JsonResponse
    {
        $kategorisuarapuan = KategoriSuaraPuan::where('id', $id)->first();
        if (!$kategorisuarapuan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $kategorisuarapuan->delete();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
