<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create(QuestionCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $question = new Question($data);
        $question->user_id = $user->id;
        $question->save();

        return (new QuestionResource($question))->response()->setStatusCode(201);
    }

    public function get(int $id): QuestionResource
    {
        $user = Auth::user();

        $question = Question::where('id', $id)->where('user_id', $user->id)->first();
        if (!$question) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new QuestionResource($question);
    }

    public function update(int $id, QuestionUpdateRequest $request): QuestionResource
    {
        $user = Auth::user();

        $question = Question::where('id', $id)->where('user_id', $user->id)->first();
        if (!$question) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $question->fill($data);
        $question->save();

        return new QuestionResource($question);
    }

    public function delete(int $id): JsonResponse
    {
        $user = Auth::user();

        $question = Question::where('id', $id)->where('user_id', $user->id)->first();
        if (!$question) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $question->delete();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
