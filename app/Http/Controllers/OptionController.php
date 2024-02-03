<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionCreateRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    private function getQuestion(User $user, int $idquestion): Question
    {
        $question = Question::where('user_id', $user->id)->where('id', $idquestion)->first();

        if (!$question) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "not found"
                    ]
                ],
            ])->setStatusCode(404));
        }

        return $question;
    }

    private function getoption(Question $question, int $idoption): Option
    {
        $option = Option::where('question_id', $question->id)->where('id', $idoption)->first();
        if (!$option) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "not found"
                    ]
                ],
            ])->setStatusCode(404));
        }

        return $option;
    }

    public function create(int $idquestion, OptionCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $question = $this->getQuestion($user, $idquestion);

        $data = $request->validated();
        $option = new Option($data);
        $option->question_id = $question->id;
        $option->save();

        return (new OptionResource($option))->response()->setStatusCode(201);
    }

    public function get(int $idquestion, int $idoption): OptionResource
    {
        $user = Auth::user();
        $question = $this->getQuestion($user, $idquestion);
        $option = $this->getoption($question, $idoption);

        return new OptionResource($option);
    }

    public function update(int $idquestion, int $idoption, OptionUpdateRequest $request): OptionResource
    {
        $user = Auth::user();
        $question = $this->getquestion($user, $idquestion);
        $option = $this->getoption($question, $idoption);


        $data = $request->validated();
        $option->fill($data);
        $option->save();

        return new OptionResource($option);
    }

    public function delete(int $idquestion, int $idoption): JsonResponse
    {
        $user = Auth::user();
        $question = $this->getquestion($user, $idquestion);
        $option = $this->getoption($question, $idoption);

        $option->delete();

        return response()->json([
            "data" => true
        ])->setStatusCode(200);
    }
}
