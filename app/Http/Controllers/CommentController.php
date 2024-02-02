<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentPuanCreateRequest;
use App\Http\Requests\CommentPuanUpdateRequest;
use App\Http\Resources\CommentPuanResource;
use App\Models\CommentPuan;
use App\Models\SuaraPuan;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private function getSuaraPuan(User $user, int $idsuarapuan): SuaraPuan
    {
        $suarapuan = SuaraPuan::where('id', $idsuarapuan)->first();

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

    private function getCommentPuan(SuaraPuan $suarapuan, int $idCommentPuan, User $user): CommentPuan
    {
        $commentpuan = CommentPuan::where('user_id', $user->id)->where('suarapuan_id', $suarapuan->id)->where('id', $idCommentPuan)->first();
        if (!$commentpuan) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "not found"
                    ]
                ],
            ])->setStatusCode(404));
        }

        return $commentpuan;
    }

    public function create(int $idsuarapuan, CommentPuanCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $suarapuan = $this->getSuaraPuan($user, $idsuarapuan);

        $data = $request->validated();
        $commentpuan = new CommentPuan($data);
        $commentpuan->user_id = $user->id;
        $commentpuan->suarapuan_id = $suarapuan->id;
        $commentpuan->save();

        return (new CommentPuanResource($commentpuan))->response()->setStatusCode(201);
    }

    public function get(int $idSuaraPuan, int $idCommentPuan): CommentPuanResource
    {
        $user = Auth::user();
        $suarapuan = $this->getSuaraPuan($user, $idSuaraPuan);

        $commentpuan = $this->getCommentPuan($suarapuan, $idCommentPuan, $user);

        return new CommentPuanResource($commentpuan);
    }

    public function update(int $idSuaraPuan, int $idCommentPuan, CommentPuanUpdateRequest $request): CommentPuanResource
    {
        $user = Auth::user();
        $suarapuan = $this->getSuaraPuan($user, $idSuaraPuan);
        $commentpuan = $this->getCommentPuan($suarapuan, $idCommentPuan, $user);


        $data = $request->validated();
        $commentpuan->fill($data);
        $commentpuan->save();

        return new CommentPuanResource($commentpuan);
    }

    public function delete(int $idSuaraPuan, int $idCommentPuan): JsonResponse
    {
        $user = Auth::user();
        $suarapuan = $this->getSuaraPuan($user, $idSuaraPuan);
        $commentpuan = $this->getCommentPuan($suarapuan, $idCommentPuan, $user);

        $commentpuan->delete();
        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
