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
                    'title'        => '泊学',
                    'description' => '讨论泊学视频或文案错误以及对泊学的看法。',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
            1 =>
                array(
                    'id'          => 3,
                    'post_count'  => 0,
                    'weight'      => 97,
                    'title'        => 'iOS',
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
                    'description' => '其他问题请在这里发布',
                    'created_at'  => '2016-07-03 10:00:00',
                    'updated_at'  => '2016-07-03 10:00:00',
                ),
        ));
    }
}

