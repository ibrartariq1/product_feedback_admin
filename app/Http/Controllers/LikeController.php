<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeFeedback(Request $request)
{

    $user = Auth::user();
    $feedback = Feedback::findOrFail(request()->feedback_id);
   

    if (!$user->likedFeedback->contains($feedback)) {
        $user->likedFeedback()->attach($feedback);
        $likesCount = $feedback->likes()->count();
        return response()->json(['error' => false,'is_liked'=>true,'likes_count'=>$likesCount]);

    }
    else{
        $user->likedFeedback()->detach($feedback);
        $likesCount = $feedback->likes()->count();
        return response()->json(['error' => false,'is_liked'=>false,'likes_count'=>$likesCount]);
    }

}
}
