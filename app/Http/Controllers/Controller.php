<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Make your own custom slug
     */
    protected function getSlug($data){
        return str_replace(' ', '-', $data);
    }

    /**
     * Make your custom video link [youtube & vimeo]
     */

    protected function getEmbed($link){
        if (strpos($link, "vimeo.com")){
            return str_replace("vimeo.com","player.vimeo.com/video", $link);
        }else{
            return str_replace('watch?v=','embed/', $link);
        }
    }
    /**
     * Image Upload Function
     */
    public function imageUpload($request, $file, $path){
        if($request->hasFile($file)){
            $img = $request->file($file);
            $unique_name = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img-> move(public_path($path), $unique_name);
            return $unique_name;
        }else{
            return '';
        }

    }
}
