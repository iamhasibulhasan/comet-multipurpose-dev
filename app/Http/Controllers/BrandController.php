<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()){
            return datatables()->of(Brand::latest()->get())->addColumn('action', function ($data){
                $output = '<a class="btn btn-warning btn-sm brand-edit" edit-brand-id="'.$data['id'].'" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $output .= ' <a class="btn btn-danger btn-sm brand-del" del-brand-id="'.$data['id'].'" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.product.brand.index');
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
     * @return array
     */
    public function store(Request $request)
    {
        $file_name='';
        if ($request->hasFile('logo')){
            $img = $request->file('logo');
            $file_name = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('media/products/brands/'), $file_name);
        }
        Brand::create([
            'name'      =>  $request->name,
            'slug'      =>  $this->getSlug($request->name),
            'logo'      =>  $file_name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $file_name= $request->old_logo;
        if ($request->hasFile('new_logo')){
            $img = $request->file('new_logo');
            $file_name = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('media/products/brands/'), $file_name);
        }

        $brand->name = $request->name;
        $brand->slug = $this->getSlug($request->name);
        $brand->logo = $file_name;
        $brand->update();
        return 'Brand updated successful!';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

//    Product brand status update
    public function statusUpdate($id){
        $status = Brand::find($id);
        if ($status->status == true){
            $status->status = false;
            $status->update();
            return "Brand deactivate successful.";
        }else{
            $status->status = true;
            $status->update();
            return "Brand activate successful.";
        }
    }
//    Product brand delete
    public function productBrandDelete($id){
        $delete_data = Brand::find($id);
        $brnad_name = $delete_data->name;
        $logo = $delete_data->logo;
        if (file_exists('media/products/brands/'.$logo)){
            unlink('media/products/brands/'.$logo);
        }
        $delete_data->delete();
        return $brnad_name;

    }
//    Product brand edit
    public function productBrandEdit($id){

        return Brand::find($id);
    }
}
