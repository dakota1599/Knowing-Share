<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        //Should render out a list of resources
        $posts = Post::latest()->paginate(3);

        return view('posts.index',['posts' => $posts]);
    }

    public function show(Post $post){
        //Presents a view with one rendered resources

        return view('posts.show',['post' =>$post]);
    }

    public function create(){
        //Shows a view to create a new resource
        if(session()->exists('auth')){
            return view('posts.create');
        }else{
            return view(route('user.sign'));
        }
    }

    public function store(){
        //Persists the new resource

        //request()->validate([
        //    'body' => ['required', 'min:4','max:255']
        //]);

        //Post::create([
        //    'body' => request('body')
        //]);

        //OR

        $this->validatePost();

        Post::create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body'),
            'category' => request('category'),
            'user_id' => session('id')
        ]);

        return redirect('/');
    }

    public function edit(Post $post){
        //Show a view to edit an existing resource

        if(session('username') != null && session('username') == $post->author->username){

            return view('posts.edit', ['post' => $post]);
        }else{
            return redirect('/')->with('lperm','You do not have permission to edit this post.');
        }
    }

    public function update(Post $post){
        //Persist the edited resource
        

        $post->update($this->validatePost());

        return view('welcome');
    }

    //To delete a post
    public function destroy(Post $post){
        //Delete the resource
        //Gets the author of the post in question.
        $author = $post->author;
        //Validates to ensure that the current user is the owner of the post.
        if(request('user') != null && request('user') == $author->username){
            $post->delete(); //Deletes
        }else{
            //If it is not the owner, it redirects back to the homepage.  In case someone attempts a direct visit.
            return redirect("/");
        }
    }

    //Validates the fields from incoming post
    private function validatePost(){
        return request()->validate([
            'title' => ['required', 'min:4','max:225'],
            'excerpt' => ['required','min:4','max:225'],
            'body' => ['required','min:4']
        ]);
    }
}
