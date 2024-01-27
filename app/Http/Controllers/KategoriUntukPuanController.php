<?php

namespace App\Http\Controllers;

use App\Http\Resources\KategoriUntukPuanResouce;
use App\Models\KategoriUnutkPuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriUntukPuanController extends Controller
{
    public function create(KategoriUntukPuanResouce $request): JsonResponse
    {
        $data = $request->validated();

        $kategori = new KategoriUnutkPuan($data);
        $kategori->save();

        return (new KategoriUntukPuanResouce($kategori))->response()->setStatusCode(200);
    }
}
