<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\PostTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\updatePosts;

class PostsController extends Controller
{


    use PostTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {


        $fileName = $this->saveImages($request->image, 'images/');



        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'image' => $fileName

        ]);

        session()->flash('success', 'post created successfully');

        return redirect(route('posts.index'));
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
        return view('posts.create' ,compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatePosts $request, $id)
    {
       

        $post = Post::find($id);
    
        $post->title = $request->title;
        $post->description= $request->description;
        $post->content = $request->content;
        $post->published_at = $request->published_at;
      
        $filename = "images/".$post->image; 
        if(File::exists($filename)) {
            File::delete($filename);
        }
      
        $file_name = $this->saveImages($request->image, 'images/');

        $post->image = $file_name;

// dd($post);
        // $filename = "images/".$post->image; 

        // if($request->has('image')) {
        //     dd('jjjjj');
          
        //     File::delete($filename);

        //     $fileName = $this->saveImages($post->image, 'images/');
   
        //        //update the database
        //        $post->image = $fileName;
        // }

        $post->save();
        session()->flash('success', 'post updated successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if ($post->trashed()){

            //  when delete the image from db it will delete it from the public folder 
            $filename = "images/".$post->image; 
            if(File::exists($filename)) {
                File::delete($filename);
            }

            $post->forceDelete();
        }else
            $post->delete();


        session()->flash('success', 'post deleted successfully');

        return redirect(route('posts.index'));
    }



    /**
     * show all trashed post 
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {

        $trashed = Post::onlyTrashed()->get(); // get the trashed post 
        // $trashed= Post::withTrashed()->get(); // get  all post even if the post is trashed 
        // $trashed= Post::withoutTrashed()->get(); // get the post without the trashed  post
        //    dd( $trashed);
        return view('posts.index')->with('posts', $trashed);
    }
}
