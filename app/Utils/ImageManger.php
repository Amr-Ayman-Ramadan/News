<?php

namespace App\Utils;

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManger
{
    public static function uploadImages($request , $post)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $filename = Str::uuid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images/posts', $filename, 'public');

                Image::create([
                    "path" => $path,
                    "post_id" => $post->id,
                ]);
            }
        }
    }

    public static function deleteImages($post)
    {
        if($post->images->count() > 0){
            foreach ($post->images as $image) {
                if(File::exists(public_path($image->path))){
                    File::delete(public_path($image->path));
                }
            }
        }
    }
}
