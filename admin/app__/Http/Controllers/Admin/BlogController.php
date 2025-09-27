<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BlogComments;
use App\Models\BlogLikes;
use App\Models\Blogs;
use App\Models\ConfessionComments;
use App\Models\Confessions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Users;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blogs::where('is_approved', 1)->get();
        return view('blog.index', compact('blogs'));
    }

    public function approval()
    {
        $blogs = Blogs::where('is_approved', 0)->get();
        return view('blog.approved', compact('blogs'));
    }

    public function approveBlog($id)
    {
        DB::table('blogs')
            ->where('id', $id)
            ->where('is_approved', 0) 
            ->update(['is_approved' => 1]);
    
            return redirect()->back()->with('success', 'Blog approved successfully.');
    }
    
    public function show($id)
    {
        $blog = Blogs::with(['likes', 'comments'])->findOrFail($id);
        return view('blog.show', compact('blog'));
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);
        $blog->likes()->delete();
        $blog->comments()->delete();
        $blog->delete();

        // return redirect()->route('blogs.index')->with('success', 'Blog deleted');
        return redirect()->back()->with('success','Blog Deleted');
    }
    public function destroyLike($id)
    {
        $like = BlogLikes::findOrFail($id);
        $like->delete();
        return redirect()->back()->with('like_delete', 'Like deleted');
    }

    public function destroyComment($id)
    {
        $comment = BlogComments::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('comment_delete', 'Comment delete');
    }

    public function create()
    {
        $blogs = Blogs::all();
        $users = Admin::all();
        return view('blog.create', compact('blogs', 'users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required|string',
            'tags' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->tags = $request->tags;
        $blog->uID = -1;
        $blog->created_at = now();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imageUrl = url('images/' . $imageName);
            $blog->image = $imageUrl;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $users = Admin::all();
        return view('blog.edit', compact('blog', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required|string',
            'tags' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blogs::findOrFail($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->tags = $request->tags;

        if ($request->hasFile('image')) {

            if ($blog->image) {

                $oldImageName = basename(parse_url($blog->image, PHP_URL_PATH));
                if (file_exists(public_path('images/' . $oldImageName))) {
                    unlink(public_path('images/' . $oldImageName));
                }
            }


            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imageUrl = url('images/' . $imageName);
            $blog->image = $imageUrl;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function allComments()
    {
        $blogComments = BlogComments::with('user')->get();
        $confessionComments = ConfessionComments::with('user')
            ->whereHas('confession', function ($query) {
                $query->where('type', 'confession');
            })
            ->get();
        $forumComments = ConfessionComments::with('user')
            ->whereHas('confession', function ($query) {
                $query->where('type', 'forum');
            })
            ->get();
        $blogCommentsData = $blogComments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'title' => Blogs::find($comment->bID)->title ?? 'Unknown Blog',
                'user_name' => $comment->user->name ?? 'Unknown User',
                'comment' => $comment->comment ?? 'No Comment Provided',
            ];
        });
        $confessionCommentsData = $confessionComments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'title' => $comment->confession->title ?? 'Unknown Confession',
                'commenter_name' => $comment->commenter_name ?? 'Unknown User',
                'comment' => $comment->comment ?? 'No Comment Provided',
            ];
        });
        $forumCommentsData = $forumComments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'title' => $comment->confession->title ?? 'Unknown Forum',
                'commenter_name' => $comment->commenter_name ?? 'Unknown User',
                'comment' => $comment->comment ?? 'No Comment Provided',
            ];
        });
        return view('all_comments', compact('blogCommentsData', 'confessionCommentsData', 'forumCommentsData'));
    }
    
    public function allCommentsDelete($id)
    {
        $comment = BlogComments::find($id) ?? ConfessionComments::find($id) ?? ConfessionComments::find($id);

        if (!$comment) {
            abort(404);
        }
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
