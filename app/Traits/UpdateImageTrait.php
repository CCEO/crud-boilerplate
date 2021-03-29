<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UpdateImageTrait {

    /**
     * @param $request
     * @return $this|false|string
     */
    public function updateImage($request, $model, $plataform, $path_name = NULL, $field_name = NULL)
    {
        if(!$field_name)
        {
            if($request->image)
                $field_name = 'image';
            elseif ($request->photo)
                $field_name = 'photo';
            else
                return abort(404,'Cannot find the photo or image field in the specified model');
        }

        if(!$path_name)
            $path_name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0',class_basename($model)));



        if($model->getOriginal($field_name)) {
            $model_image = $model->getOriginal($field_name);
        } else $model_image = null;

        $model->$field_name = $model->getOriginal($field_name);

        if ($request->$field_name) {
            try {
                if (isset($model_image)) {
                    Storage::disk('public')->delete($model_image);
                }
            } catch (Exception $e) {}
            if($plataform == 'web')
                $model->$field_name = Storage::disk('public')->put($path_name, $request->$field_name);
            elseif($plataform == 'mobile'){
                $image_name = $path_name.'/'.Str::random(32) . '.jpeg';
                Storage::disk('public')->put($image_name, base64_decode($request->$field_name));
                $model->$field_name = $image_name;
            }

        }

    }

}
