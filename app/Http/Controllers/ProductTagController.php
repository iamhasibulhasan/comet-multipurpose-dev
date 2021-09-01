<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(ProductTag::latest()->get())->addColumn('action', function ($data){
                $output = '<a class="btn btn-warning btn-sm ptag-edit" edit-ptag-id="'.$data['id'].'" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $output .= ' <a class="btn btn-danger btn-sm ptag-del" del-ptag-id="'.$data['id'].'" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.product.tag.index');
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
        ProductTag::create([
            'name'      =>  $request->name,
            'slug'      =>  $this->getSlug($request->name)
        ]);
        return 'Tag added successful';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTag $productTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ProductTag::find($id);
        $data->name = $request->name;
        $data->slug = $this->getSlug($request->name);
        $data->update();
        return 'Tag updated successful!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTag $productTag)
    {
        //
    }

    //    Product brand status update
    public function statusUpdate($id){
        $status = ProductTag::find($id);
        if ($status->status == true){
            $status->status = false;
            $status->update();
            return "Tag deactivate successful.";
        }else{
            $status->status = true;
            $status->update();
            return "Tag activate successful.";
        }
    }

//    Product tag delete
    public function productTagDelete($id){
        $delete_data = ProductTag::find($id);
        $tag_name = $delete_data->name;
        $delete_data->delete();
        return $tag_name;

    }
//    Product tag edit
public function productTagEdit($id){
        $data = ProductTag::find($id);
        return $data;
}




}
