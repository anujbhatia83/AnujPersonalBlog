<?php
namespace App\Repositories;

use DB;
use App\Blog;
use Session;
use Auth;

class BlogRepository
{

    public function getBlog($userID)
    {
         if(isset($userID)) {
             $blogs = DB::table('blog_posts')
                ->select('blog_posts.id','post','title','user_id','blog_posts.created_at','name')
                ->where('user_id', $userID)
                ->join('users', 'users.id', '=', 'blog_posts.user_id')
                ->orderBy('created_at', 'DESC')
                ->get();
          } else {
              $blogs = DB::table('blog_posts')
                ->select('blog_posts.id','post','title','user_id','blog_posts.created_at','name')
                ->join('users', 'users.id', '=', 'blog_posts.user_id')
                ->orderBy('created_at', 'DESC')
                ->get();
          }      

        return $blogs;
    }

    public function setBlog($data)
    {
        $blog = new Blog;

        $blog->title = $data['title'];
        $blog->post = strip_tags($data['post']); 
        $blog->user_id = Auth::user()->id;
        $blog->save();

        return true;
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete($id);
    }

    public function update($data)
    {
        $post = strip_tags($data['post']);
        $blog = Blog::find($data['blogID']);
        $blog->post = $post;
        $blog->save();
    }

}