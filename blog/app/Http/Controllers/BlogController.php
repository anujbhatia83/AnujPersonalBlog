<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use DB;
use Input;
use Redirect;
use Auth;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(BlogRepository $blog)
    {
        $this->blog = $blog;
    }
    

    //public function __construct()
    //{
      //  $this->middleware('auth');
    //}

    public function home()
    {
        $data['blogs'] = $this->blog->getBlog(null);

        return view('pages.viewBlogs')->with('data',$data);
    }

    public function addBlog() 
    {
        return view('pages.addBlogs');
    }

    public function saveBlog()
    {
        $data = Input::all();

        if($this->blog->setBlog($data)) {
            return Redirect::to('sportsmed/viewuserblog')->with('message', 'Blog Saved !');
        }    
    }

    public function viewUserBlogs()
    {
        $userId = Auth::user()->id;

        $data['blogs'] = $this->blog->getBlog($userId);
        //$data['blogs'] = DB::table('blog_posts')->where('user_id', $userId)->get();

        return view('pages.viewBlogs')->with('data',$data);
    }

    public function manageBlogs()
    {
        $userId = Auth::user()->id;

        $data['blogs'] = $this->blog->getBlog($userId); 
        
        return view('pages.manageBlogs')->with('data',$data);
    }

    public function deleteBlog()
    {
        $data = Input::all();

        if ($this->blog->delete($data['blogID'])) {
            return Redirect::back();
        }

    }

    public function updateBlog()
    {
        $data = Input::all();

        if ($this->blog->update($data)) {
            return Redirect::back();
        }
    }


}