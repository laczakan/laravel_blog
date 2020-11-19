<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->where('status', 'active')->paginate(4);

        return view('articles.index')
            ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->where('status', 'active');
        return view('articles.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:150'],
            'content' => ['required', 'min:3'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['image', 'nullable', 'max:1999'],
            'status' => ['required', 'in:' . join(',', Article::POSSIBLE_STATUSES)]
        ]);

        if ($request->hasFile('image')) {
            //get just extention
            $extention = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = uniqid() . '.' . $extention;

            //upload image
            $path = $request->file('image')->storeAs('public/upload/articles', $fileNameToStore);
        } else {
            $fileNameToStore = 'null.jpeg';
        }

        $article = new Article;
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');
        $article->status = $request->input('status');
        $article->user_id = Auth::id();
        $article->image = $fileNameToStore;
        $article->updated_at = null;
        $article->save();

        return redirect('/articles')->with('success', 'Article Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     */
    public function show(Article $article)
    {
        $comments = $article->comments;
        $user = $article->user_id;

        return view('articles.show')
            ->with('article', $article)
            ->with('user', $user)
            ->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Article $article
     */
    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('articles.edit')
            ->with('article', $article)
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required', 'min:3', 'max:150',
            'content' => 'required', 'min:3',
            'category_id' => 'required', 'exists:categories,id',
            'image' => 'image', 'nullable', 'max:1999',
            'status' => 'required', 'in:' . join(',', Article::POSSIBLE_STATUSES)
        ]);

        if ($request->hasFile('image')) {
            //get just extention
            $extention = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = uniqid() . '.' . $extention;

            //upload image
            $path = $request->file('image')->storeAs('public/upload/articles', $fileNameToStore);

            $article->image = $fileNameToStore;
        }

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');
        $article->status = $request->input('status');
        $article->save();

        return redirect('/articles/' . $article->id)->with('success', 'Article edited succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     */
    public function destroy(Article $article)
    {
        $comments = $article->comments;

        foreach ($comments as $comment) {
            $comment->delete();
        }

        //   softdelete
        $article->delete();

        return redirect('articles')->with('success', 'Article deleted');
    }
}
