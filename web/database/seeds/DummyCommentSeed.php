<?php

use Illuminate\Database\Seeder;
use App\Comment;

class DummyCommentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 12)->create();
    }
}
