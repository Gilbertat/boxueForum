<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array(
            0 =>
                array(
                    'id'          => 1,
                    'post_count'  => 0,
                    'weight'      => 100,
                    'title'       => '泊学',
                    'color'       => '#1bb1b2',
                    'description' => '讨论泊学视频或文案错误以及对泊学的看法。',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            1 =>
                array(
                    'id'          => 3,
                    'post_count'  => 0,
                    'weight'      => 97,
                    'title'       => 'iOS',
                    'color'       => '#5b95dc',
                    'description' => '开发iOS时遇到的困难及问题。',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            2 =>
                array(
                    'id'          => 4,
                    'post_count'  => 0,
                    'weight'      => 99,
                    'title'        => 'PHP',
                    'color'       => '#6e8ebc',
                    'description' => '开发PHP时遇到的问题及困难',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            3 =>
                array(
                    'id'          => 5,
                    'post_count'  => 0,
                    'weight'      => 98,
                    'title'        => '闲侃',
                    'color'       => '#a5a5a5',
                    'description' => '只要不涉黄涉恐涉暴，想说啥就说啥',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            4 =>
                array(
                    'id'          => 6,
                    'post_count'  => 0,
                    'weight'      => 97,
                    'title'        => '其他',
                    'color'       => '#f8b2b9',
                    'description' => '其他问题请在这里发布',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            5 =>
                array(
                    'id'          => 7,
                    'post_count'  => 0,
                    'weight'      => 90,
                    'title'        => '11大讲堂',
                    'color'       => '#cce7ff',
                    'description' => '11的经验谈',
                    'created_at'  => '2017-07-31 9:00:00',
                    'updated_at'  => '2017-07-31 9:00:00',
                ),
            6 =>
                array(
                    'id'          => 8,
                    'post_count'  => 0,
                    'weight'      => 92,
                    'title'        => '装备',
                    'color'       => '#26ac21',
                    'description' => '群友设备交易',
                    'created_at'  => '2017-07-31 9:00:00',
                    'updated_at'  => '2017-07-31 9:00:00',
                ),
            7 =>
                array(
                    'id'          => 9,
                    'post_count'  => 0,
                    'weight'      => 90,
                    'title'        => '面试',
                    'color'       => '#303131',
                    'description' => '群友设备交易',
                    'created_at'  => '2017-08-04 13:00:00',
                    'updated_at'  => '2017-08-04 13:00:00',
                ),
        ));
    }
}

