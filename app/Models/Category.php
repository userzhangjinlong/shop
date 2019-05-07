<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $tables = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'pid', 'description', 'cateicon'
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * 无限极分类树
     * @param int $pid
     * @return array
     */
    public function cateTree($pid = 0, $level = 0){
        $list = $this->where('pid', $pid)->orderBy('id', 'desc')->get();
        $arr = [];
        if (!empty($list)){
            foreach ($list as $k => $v){
                $v['level'] = $level;
                $level++;
                $v['bs'] = str_repeat('-', $level);
                $v['list'] = $this->cateTree($v->id, $level);
                $arr[] = $v;

            }
        }
        return $arr;

    }

    public function getTree($pid = 0, $level = 0){

    }


//    public function tree()
//    {
//        $category = $this->orderBy('id','asc')->get();
//        return $this->getTree($category,'name','id','pid','0');
//
//    }
//
//    public function getTree($data,$filed_name,$filed_id,$filed_fid,$pid)
//    {
//        $arr = array();
//        foreach ($data as $k=>$v){
//            if ($v->$filed_fid==$pid){
//                $data[$k]['_'.$filed_name] =$data[$k][$filed_name];
//                $arr[]=$data[$k];
//                foreach ($data as $m =>$n){
//                    if ($n ->$filed_fid == $v->$filed_id){
//                        $data[$m]['_'.$filed_name] ="&nbsp;┣".$data[$m][$filed_name];
//                        $arr[]=$data[$m];
//                    }
//                }
//            }
//        }
//        return $arr;
//    }
}
