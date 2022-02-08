<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        if ($categories->count()==0 || $tags->count() == 0) {
            Session::flash('error','you should to create category or tags');
            return redirect( )->back();
        }
        return view('admin.posts.create')->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'featured' => 'required|image',
            'category_id' => 'required',
            'tags' => 'required'
        ]);

        $featured = $request->featured;

        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);
       // dd($request->description);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->description,
            'category_id' => $request->category_id,
            'featured'=> 'uploads/posts'.$featured_new_name,
            'slug' =>  Str::slug($request->title, '-'),
            'user_id'=>Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        $post->save();
        Session::flash('success','Category saved successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit')->with('post',$post)->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
           'title' => 'required',
           'description' => 'required',
           'category_id' => 'required'
        ]);
        $post = Post::find($id);
        if ($request->hasFile('featured')) {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts',$featured_new_name);
            $post->featured ='uploads/posts/'.$featured_new_name;
        }
        $post->title = $request->title;
        $post->content = $request->description;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags,$detaching = true);
        Session::flash('success','Post updated Successfully');
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success','The post was just trashed.');
        return redirect()->back();
    }

    public function trashed() {
     $post = Post::onlyTrashed()->get();
      return view('admin.posts.trashed')->with('posts',$post);
    }
    public function kill($id) {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        Session::flash('success','post deleted success');
        return redirect()->back();
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        Session::flash('success', 'Post Restored Successfully');
        return redirect()->route('posts');
    }
}
