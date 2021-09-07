<?php

namespace App\Http\Controllers;

use App\Models\Productcategory;
use Illuminate\Http\Request;
use Psr\Log\NullLogger;

class ProductcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Productcategory::latest()->get();
        $parent_category = Productcategory::where('parent', Null)->get();
        return view('admin.product.category.index', [
            'all_data'             =>  $all_data,
            'parent_category'      =>  $parent_category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Category Image Upload
        $image = $this->imageUpload($request, 'image', 'media/products/category/');


        //Check Parent Category
        $parent = NULL;


        Productcategory::create([
            'name'          =>  $request->name,
            'slug'          =>  $this->getSlug($request->name),
            'icon'          =>  $request->icon,
            'image'         =>  $image,
            'parent'        =>  (!empty($request->parent)) ? $request->parent : NULL,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Productcategory $productcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Productcategory $productcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productcategory $productcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productcategory $productcategory)
    {
        //
    }

    /**
     * @param Category Destroy
     *
     */
    public function categoryDestroy($id)
    {
        $delete_cat = Productcategory::find($id);
        $parent_id = $delete_cat->parent;
        $data_id = $delete_cat->id;
//        Call cat manage function
        $this->catManage($data_id, $parent_id);

        $delete_cat->delete();
        return back();
    }

//    Get child function
    public function catManage($id, $parent){
        $child = Productcategory::where('parent', $id)->get();
        foreach ($child as $c){
            $c->parent = $parent;
            $c->update();
        }
    }
//    Product category edit modal
    public function categoryEdit($id){
        $data = Productcategory::find($id);
        $all_cat = Productcategory::all();

//      Parent Category
        $cat_list = "<option value=''>-selected-</option>";
        foreach ($all_cat as $cat){
            $selected = '';
            if ($cat->id == $data->parent){
                $selected = 'selected';
            }
            $cat_list .= "<option {$selected} value='{$cat->id}'>{$cat->name}</option>";
        }



        return [
            'id'        => $data->id,
            'name'      => $data->name,
            'icon'      => $data->icon,
            'image'     => $data->image,
            'parent'    => $data->parent,
            'cat_list'  => $cat_list,
        ];
    }
}
