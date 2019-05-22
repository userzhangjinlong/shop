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
     * @return array
     */
    public function tree()
    {
        $category = $this->orderBy('id','asc')->get();
        return $this->getTree($category,'name','id','pid','0');

    }

    /**
     * 目前支持到6级的无限极分类(待优化)
     * @param $data
     * @param $filed_name
     * @param $filed_id
     * @param $filed_fid
     * @param $pid
     * @return array
     */
    public function getTree($data,$filed_name,$filed_id,$filed_fid,$pid)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if ($v->$filed_fid==$pid){
                $data[$k][$filed_name] ="|-".$data[$k][$filed_name];
                $arr[]=$data[$k];
                foreach ($data as $m =>$n){
                    if ($n ->$filed_fid == $v->$filed_id){
                        $data[$m][$filed_name] ="|- -".$data[$m][$filed_name];
                        $arr[]=$data[$m];
                        foreach($data as $a => $b){
                            if($b->$filed_fid == $n->$filed_id){
                                $data[$a][$filed_name] ="|- - -".$data[$a][$filed_name];
                                $arr[]=$data[$a];
                                foreach ($data as $c => $d){
                                    if($d->$filed_fid == $b->$filed_id){
                                        $data[$c][$filed_name] ="|- - - -".$data[$c][$filed_name];
                                        $arr[]=$data[$c];
                                        foreach ($data as $e => $f){
                                            if ($f->$filed_fid == $d->$filed_id){
                                                $data[$e][$filed_name] ="|- - - - -".$data[$e][$filed_name];
                                                $arr[]=$data[$e];
                                                foreach($data as $g => $h){
                                                    if ($h->$filed_fid == $f->$filed_id){
                                                        $data[$g][$filed_name] ="|- - - - - -".$data[$g][$filed_name];
                                                        $arr[]=$data[$g];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }


    public function getOneCate($id){
        return $this->find($id);
    }

    public function getGoodsList(){
        return $this->belongsToMany(Goods::class, 'goods', 'cate_id');
    }

}
