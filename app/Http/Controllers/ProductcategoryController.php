<?php

namespace App\Http\Controllers;

use App\Models\Productcategory;
use Illuminate\Http\Request;

class ProductcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Productcategory::orderby('name', 'ASC')->get();
        $parent_category = Productcategory::where('level', 0)->where('parent', NULL)->get();
        return view('admin.product.category.index', [
            'all_data'      =>  $all_data,
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $this->imageUpload($request, 'image', 'media/products/category/');

        if (empty($request->parent)){
            Productcategory::create([
                'name'          =>  $request->name,
                'slug'          =>  $this->getSlug($request->name),
                'image'         =>  $image
            ]);
        }else{
            $parent = Productcategory::find($request->parent);
            Productcategory::create([
                'name'          =>  $request->name,
                'slug'          =>  $this->getSlug($request->name),
                'image'         =>  $image,
                'level'         =>  $parent->level + 1,
                'parent'        =>  $parent->id,
            ]);
        }

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
}
