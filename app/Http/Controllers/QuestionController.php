<?php

// app/Http/Controllers/QuestionController.php
namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::with('replies')->get();
    }

    public function store(Request $request)
    {
        $question = Question::create($request->all());
        return response()->json($question, 201);
    }

    public function show($id)
    {
        $question = Question::with('replies')->findOrFail($id);
        return response()->json($question);
    }

    public function storeReply(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $reply = $question->replies()->create($request->all());
        return response()->json($reply, 201);
    }

    public function search($query)
    {
        $questions = Question::where('question', 'like', "%{$query}%")
                             ->with('replies')
                             ->get();
        return response()->json($questions);
    }

    public function markAsSolved($id)
{
    $question = Question::find($id);
    if ($question) {
        $question->solved = true; // Assuming 'solved' is a boolean field in your 'questions' table
        $question->save();

        return response()->json(['status' => true, 'message' => 'Question marked as solved']);
    }

    return response()->json(['status' => false, 'message' => 'Unable to mark question as solved'], 404);
}


    public function addComment(Request $request, $id)
    {
    $comment = new Comment();
    $comment->question_id = $id;
    $comment->user_id = Auth::id();
    $comment->text = $request->text;
    $comment->save();

    return response()->json($comment);
    }

    public function addHeart($id)
    {
    $question = Question::find($id);
    $question->hearts += 1;
    $question->save();

    return response()->json(['hearts' => $question->hearts]);
    }

    public function getSolvedQuestions()
    {
    $solvedQuestions = Question::where('solved', true)->get();
    return response()->json($solvedQuestions);
    }

    public function likeQuestion($id)
{
    $question = Question::find($id);
    if ($question) {
        $question->likes += 1;
        $question->save();

        return response()->json(['likes' => $question->likes]);
    }

    return response()->json(['error' => 'Question not found'], 404);
}

 

}
