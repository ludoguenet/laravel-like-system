<?php

use App\Like;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
        factory(Post::class, 20)->create();

        for ($i=0; $i < 30; $i++) {
            $like = new Like();

            $like->user_id = User::all()->random(1)->first()->id;
            $like->post_id = Post::all()->random(1)->first()->id;

            $like->save();
        }
    }
}
