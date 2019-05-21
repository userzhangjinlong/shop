<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * ckedtior公共图片上传(单图)
     *
     * @param Request $request
     * @param string $path
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $path = 'public'){
        $cb = $request->get('CKEditorFuncNum');
        $floder = 'Uploads/'.$path.'/'.date('Ymd');
        if (!Storage::disk('public')->exists($floder)){
            Storage::makeDirectory($floder, 0775, true);
        }

        if ($request->file('upload')){

            $extension = $request->file('upload')->getClientOriginalExtension();
            $rule = ['jpg', 'png', 'gif', 'jpeg'];
                if (!in_array($extension, $rule)) {
                    echo "<script>window.parent.CKEDITOR.tools.callFunction($cb, '', '图片格式需要为jpg,png,gif格式');</script>";
                    return;
                }
            $fileName = time() . mt_rand(1, 999) . '.'. $extension;
            $request->file('upload')->move($floder,$fileName);
            $path = '/'.$floder.'/'.$fileName;
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction($cb,'$path','');</script>";
        }else{
            echo "<script>window.parent.CKEDITOR.tools.callFunction($cb, '', '请选择您要上传的图片');</script>";
        }
    }
}
