<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriUntukPuanCreateRequest;
use App\Http\Requests\KategoriUntukPuanUpdateRequest;
use App\Http\Resources\KategoruUntukPuanResource;
use App\Models\KategoriUntukPuan;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KategoriUntukPuanController extends Controller
{
    public function create(KategoriUntukPuanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (KategoriUntukPuan::where('nama_kategori', $data['nama_kategori'])->count() == 1) {
            throw new HttpResponseException(response([
                "errors" => [
                    "nama_kategori" => [
                        "Nama kategori untuk puan sudah ada."
                    ]
                ]
            ], 400));
        }

        $kategoriUntukPuan = new KategoriUntukPuan($data);
        $kategoriUntukPuan->save();

        return (new KategoruUntukPuanResource($kategoriUntukPuan))
            ->response()
            ->setStatusCode(201);
    }

    public function get(int $id): KategoruUntukPuanResource
    {
        $kategoriUntukPuan = KategoriUntukPuan::where('id', $id)->first();
        if (!$kategoriUntukPuan) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "Kategori Untuk puan tidak ditemukan."
                    ]
                ]
            ], 404));
        }

        return new KategoruUntukPuanResource($kategoriUntukPuan);
    }

    public function update(int $id, KategoriUntukPuanUpdateRequest $request): KategoruUntukPuanResource
    {
        $kategoriUntukPuan = KategoriUntukPuan::where('id', $id)->first();
        if (!$kategoriUntukPuan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $kategoriUntukPuan->fill($data);
        $kategoriUntukPuan->save();

        return new KategoruUntukPuanResource($kategoriUntukPuan);
    }

    public function delete(int $id): JsonResponse
    {
        $kategoriUntukPuan = KategoriUntukPuan::where('id', $id)->first();
        if (!$kategoriUntukPuan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $kategoriUntukPuan->delete();

        return response()->json([
            'data' => true
        ])->setStatusCode(201);
    }
}
