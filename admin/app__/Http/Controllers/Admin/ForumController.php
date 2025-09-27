<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfessionComments;
use App\Models\ConfessionLikes;
use App\Models\Confessions;

class ForumController extends Controller
{
    public function showForum()
    {
        $confessions = Confessions::where('type', 'forum')->get();
        return view('forums.index', compact('confessions'));
    }
    public function show($id)
    {
        $confession = Confessions::with(['confession_likes', 'confession_comments'])->findOrFail($id);
        return view('forums.show', compact('confession'));
    }

    public function destroy($id)
    {
        $confession = Confessions::findOrFail($id);
        $confession->confession_likes()->delete();
        $confession->confession_comments()->delete();
        $confession->delete();

          return redirect()->back()->with('success', 'Confession deleted');
        // return redirect()->route('forums.index')->with('success', 'Forum deleted');
    }

    public function destroyLike($id)
    {
        $like = ConfessionLikes::findOrFail($id);
        $like->delete();
        return redirect()->back()->with('like_delete', 'Like deleted');
    }

    public function destroyComment($id)
    {
        $comment = ConfessionComments::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('comment_delete', 'Comment deleted');
    }
}
