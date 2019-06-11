<?php
/**
 * Created by PhpStorm.
 * User: zjl
 * Date: 19-6-6
 * Time: 下午2:44
 */

namespace App\Http\ViewComposers;


use App\Models\Category;
use Illuminate\View\View;

class SharedDataComposer
{
    /**
     * @param View $view
     * @param Category $category
     */
    public function compose(View $view){
        $category = new Category();
        $view->with('cate_list', $category->sharedDataCate());
        $view->with('cate_One', $category->getOneStepCate());
    }
}