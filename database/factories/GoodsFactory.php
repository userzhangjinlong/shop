<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Goods::class, function (Faker $faker) {
        $image = $faker->randomElement([
            "https://cdn.learnku.com/uploads/images/201806/01/5320/7kG1HekGK6.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/1B3n0ATKrn.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/r3BNRe4zXG.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/C0bVuKB2nt.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/82Wf2sg8gM.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/nIvBAQO5Pj.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/XrtIwzrxj7.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/uYEHCJ1oRp.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/2JMRaFwRpo.jpg",
            "https://cdn.learnku.com/uploads/images/201806/01/5320/pa7DrV43Mw.jpg",
        ]);

        $cate_arr = [3,4,7,8];

        $brand_id = [1,2,3,4];

    return [
        'cate_id'           =>  $cate_arr[rand(0,3)],
        'goods_name'        =>  $faker->word,
        'desc'              =>  $faker->sentence,
        'tags'              =>  implode(',', [$faker->name, $faker->name, $faker->name]),
        'original_price'    =>  $faker->randomNumber(4),
        'present_price'     =>  $faker->randomNumber(3),
        'thumb_img'         =>  $image,
        'carousel_img'      =>  implode(',', [$image,$image,$image]),
        'stock'             =>  $faker->randomNumber(5),
        'postage'           =>  $faker->randomNumber(2),
        'post_free'         =>  0.00,
        'full_price'        =>  $faker->randomNumber(3),
        'ensure'            =>  $faker->realText(200, 2),
        'goods_detail'      =>  $faker->realText(400, 2),
        'created_at'        =>  $faker->dateTimeThisMonth,
        'updated_at'        =>  $faker->dateTimeThisMonth,
        'order'             =>  0,
        'brand_id'          =>  $brand_id[rand(0,3)],
        'sales'             =>  0,
        'hot'               =>  rand(0,1),
        'best_good'         =>  rand(0,1),
        'spike'             =>  0,
        'spike_price'       =>  0.00,
        'spike_b_time'      =>  $faker->dateTimeThisMonth,
        'spike_e_time'      =>  $faker->dateTimeThisMonth,
        'group_buy'         =>  0,
        'broup_buy_num'     =>  0,
        'group_buy_price'   =>  0.00,
        'group_buy_s_price' =>  0.00,
        'sale_num'          =>  $faker->randomNumber(3),
    ];

});
