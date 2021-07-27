<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Post::where('trash', false)->get();
        return view('admin.post.index', [
            'all_data'  =>  $all_data
        ]);
    }

    /**
     * Post Trash Page Load
     */

    public function postTrash()
    {
        $all_data = Post::where('trash', true)->get();
        return view('admin.post.trash', [
            'all_data'  =>  $all_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $all_category = Category::all();
        $all_tag = Tag::all();
        return view('admin.post.create',[
            'all_category'  =>  $all_category,
            'all_tag'  =>  $all_tag
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_title'     =>  'required',
            'post_content'   =>  'required'
        ]);
        $unique_name_post_image = '';
        if ($request->hasFile('post_image')){
            $image = $request->file('post_image');
            $unique_name_post_image = md5(time().rand()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('media/posts/'), $unique_name_post_image);
        }

        $unique_name_post_gallery = [];
        if ($request->hasFile('post_gallery')){
            foreach ($request->file('post_gallery') as $img){
                $unique_gallery = md5(time().rand()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('media/posts/'), $unique_gallery);
                array_push($unique_name_post_gallery, $unique_gallery);
            }
        }

        $post_featured = [
            'post_type'             =>  $request->post_type,
            'post_image'            =>  $unique_name_post_image,
            'post_gallery'          =>  $unique_name_post_gallery,
            'post_video'            =>  $request->post_video,
            'post_audio'            =>  $request->post_audio
        ];




        Post::create([
            'title'     =>  $request->post_title,
            'slug'     =>  Str::slug($request->post_title),
            'featured'     =>  json_encode($post_featured),
            'content'     =>  $request->post_content
        ]);

        return redirect()->back()->with('success', 'New post published !');
//        return $request->all();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Post Status Update[Active Or Inactive]
     */
    public function postStatusInactive($id){
        $status_update = Post::find($id);
        $status_update -> status = false;
        $status_update -> update();
    }

    public function postStatusActive($id){
        $status_update = Post::find($id);
        $status_update -> status = true;
        $status_update -> update();
    }
}
