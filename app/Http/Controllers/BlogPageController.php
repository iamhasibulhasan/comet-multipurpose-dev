<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
//    Load Blog Page

    public function showBlogPage(){

        $all_posts = Post::where('status', true)->where('trash', false)->latest()->paginate(10);
        return view('forntend.blog', [
            'all_posts'     =>  $all_posts
        ]);
    }

    /**
     * Blog Post Search
     */
    public function blogSearch(Request $request){

        $search_key = $request->search;

        $posts = Post::where('title', 'LIKE', '%'. $search_key .'%')->orWhere('content', 'LIKE', '%'. $search_key .'%')->latest()->paginate(10);
        return view('forntend.blog-search', [
            'all_posts'     =>  $posts
        ]);
    }

    public function blogSearchByCat($slug){
        $cats = Category::where('slug', $slug)->first();
        return view('forntend.category-blog', [
            'all_posts'     =>  $cats->posts
        ]);
    }

    /**
     * Sing Blog Show
     */

    public function blogSingle($slug){
        $single_post = Post::where('slug', $slug)->first();
        $this->viewCount($single_post->id);
        return view('forntend.blog-single', compact('single_post'));
    }

    /**
     * Post view count
     */
    private function viewCount($post_id){
        $post = Post::find($post_id);
        $old_views = $post->views;
        $post->views = $old_views + 1;
        $post->update();

    }

    /**
     * Post search by Tags
     */
    public function blogSearchByTag($slug){
        $tags = Tag::where('slug', $slug)->first();

        return view('forntend.tag-blog', [
            'all_posts'     =>  $tags->posts
        ]);
    }
}
