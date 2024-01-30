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
    private function getKategoriSuaraPuan(User $user, int $idKategori): KategoriSuaraPuan
    {
        $kategori = KategoriSuaraPuan::where('id', $idKategori)->first();

        if (!$kategori) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "not found"
                    ]
                ],
            ])->setStatusCode(404));
        }

        return $kategori;
    }

    private function getSuaraPuan(KategoriSuaraPuan $kategori, int $idSuaraPuan, User $user): SuaraPuan
    {
        $suarapuan = SuaraPuan::where('user_id', $user->id)->where('kategori_id', $kategori->id)->where('id', $idSuaraPuan)->first();
        if (!$suarapuan) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "not found"
                    ]
                ],
            ])->setStatusCode(404));
        }

        return $suarapuan;
    }

    public function create(int $idKategori, SuaraPuanCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $kategori = $this->getKategoriSuaraPuan($user, $idKategori);

        $data = $request->validated();
        $suarapuan = new SuaraPuan($data);
        $suarapuan->user_id = $user->id;
        $suarapuan->kategori_id = $kategori->id;
        $suarapuan->save();

        return (new SuaraPuanResource($suarapuan))->response()->setStatusCode(201);
    }

    public function get(int $idKategori, int $idSuaraPuan): SuaraPuanResource
    {
        $user = Auth::user();
        $kategori = $this->getKategoriSuaraPuan($user, $idKategori);

        $suarapuan = $this->getSuaraPuan($kategori, $idSuaraPuan, $user);

        return new SuaraPuanResource($suarapuan);
    }

    public function update(int $idKategori, int $idSuaraPuan, SuaraPuanUpdateRequest $request): SuaraPuanResource
    {
        $user = Auth::user();
        $kategori = $this->getKategoriSuaraPuan($user, $idKategori);
        $suarapuan = $this->getSuaraPuan($kategori, $idSuaraPuan, $user);

        $data = $request->validated();
        $suarapuan->fill($data);
        $suarapuan->save();

        return new SuaraPuanResource($suarapuan);
    }

    public function delete(int $idKategori, int $idSuaraPuan): JsonResponse
    {
        $user = Auth::user();
        $kategori = $this->getKategoriSuaraPuan($user, $idKategori);
        $suarapuan = $this->getSuaraPuan($kategori, $idSuaraPuan, $user);

        $suarapuan->delete();
        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }

}
