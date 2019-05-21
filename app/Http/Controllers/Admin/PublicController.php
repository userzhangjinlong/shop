<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * ckedtior公共图片上传
     *
     * @param Request $request
     * @param string $path
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $path = 'public'){

        $floder = 'Uploads/'.$path.'/'.date('Ymd');
        if (!Storage::disk('public')->exists($floder)){
            Storage::makeDirectory($floder, 0775, true);
        }

        if ($request->file('upload')){
//            $img_path = [];
            $img_path = '';
            foreach ($request->file('upload') as $k => $v){
                $extension = $v->getClientOriginalExtension();
                $rule = ['jpg', 'png', 'gif', 'jpeg'];
                if (!in_array($extension, $rule)) {
                    return response()->json(['code' => 400, 'msg' => '图片格式需要为jpg,png,gif格式']);
//                    return '图片格式需要为jpg,png,gif格式';
                }
                $fileName = time() . mt_rand(1, 999) . '.'. $extension;
                $v->move($floder,$fileName);
//                $v->storeAs($floder,$fileName);
//                $img_path[] = $floder.'/'.$fileName;
                $img_path .= '<img src="'.'/'.$floder.'/'.$fileName.'">';
            }
//            return response()->json(['code' => 200, 'msg' => '上传成功', 'imgs' => $img_path]);
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".count($request->file('upload')).",'$img_path','');</script>";
//            return $img_path;
        }else{
            return response()->json(['code' => 400, 'msg' => '请选择您要上传的图片']);
        }
    }
}
