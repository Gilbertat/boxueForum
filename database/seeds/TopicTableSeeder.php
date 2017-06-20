<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['1', '7', '4', '2', '6', '8', '9', '3', '22', '11', '10'];
        $category_ids = ['1', '3', '4', '5', '6'];

        $faker = app(Faker\Generator::class);
        $topics = factory(Topic::class)->times(100)->make()->each(function ($topic) use ($faker, $user_ids, $category_ids){
           $topic->user_id = $faker->randomElement($user_ids);
           $topic->category_id = $faker->randomElement($category_ids);
           $topic->slug = slug(\Carbon\Carbon::now()->timestamp, $topic->user_id);
        });

        Topic::insert($topics->toArray());

    }
}
