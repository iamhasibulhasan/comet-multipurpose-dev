<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $published = Post::where('trash', false)->get()->count();
        $trash = Post::where('trash', true)->get()->count();
        return view('admin.post.index', [
            'all_data'  =>  $all_data,
            'published'  =>  $published,
            'trash'  =>  $trash,
        ]);
    }

    /**
     * Post Trash Page Load
     */

    public function postTrash()
    {
        $all_data = Post::where('trash', true)->get();
        $published = Post::where('trash', false)->get()->count();
        $trash = Post::where('trash', true)->get()->count();
        return view('admin.post.trash', [
            'all_data'  =>  $all_data,
            'published'  =>  $published,
            'trash'  =>  $trash,
        ]);
    }

    /**
     * Post Trash Update
     */

    public function postTrashUpdate($id)
    {
        $trash_data = Post::find($id);

        if($trash_data->trash == false){
            $trash_data ->trash = true;
            $trash_data -> update();
            return redirect()->back()->with('success', 'Post trashed successful.');
        }else{
            $trash_data ->trash = false;
            $trash_data -> update();
            return redirect()->back()->with('success', 'Post restore successful.');
        }


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
            'post_video'            =>  parent::getEmbed($request->post_video),
            'post_audio'            =>  $request->post_audio
        ];




        $post_data = Post::create([
            'title'         =>  $request->post_title,
            'user_id'       =>  Auth::user()->id,
            'slug'          =>  parent::getSlug($request->post_title),
            'featured'      =>  json_encode($post_featured),
            'content'       =>  $request->post_content
        ]);

//        category_post Table relation
        $post_data->categories()->attach($request->post_category);
        $post_data->tags()->attach($request->tags);
//        return $request->all();

        return redirect()->back()->with('success', 'New post published !');

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
        $delete_data = Post::find($id);

        $featured = json_decode( $delete_data->featured );

        if($featured->post_type == 'Image'){
            if (file_exists('media/posts/'. $featured->post_image)) {
                unlink('media/posts/'. $featured->post_image);
            }
        }elseif ($featured->post_type == 'Gallery'){
            foreach ($featured->post_gallery as $photo){
                if (file_exists('media/posts/'. $photo)) {
                    unlink('media/posts/'. $photo);
                }
            }
        }

//        Detach cat_post, post_tag
        $delete_data->categories()->detach($delete_data->post_category);
        $delete_data->tags()->detach($delete_data->tags);
        $delete_data -> delete();
        return redirect()->back()->with('success', 'Data deleted permanently.');
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
