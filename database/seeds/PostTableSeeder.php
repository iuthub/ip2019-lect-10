<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post([
        	'title' => 'Some topic',
        	'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia dignissimos nostrum corrupti placeat vitae, consequuntur ut. Eius rem, sit aliquid aspernatur minus eligendi, recusandae voluptates doloribus numquam autem blanditiis ratione!'
        ]);
        $post->save();

        $post = new Post([
        	'title' => 'Some topic 2',
        	'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia dignissimos nostrum corrupti placeat vitae, consequuntur ut. Eius rem, sit aliquid aspernatur minus eligendi, recusandae voluptates doloribus numquam autem blanditiis ratione!'
        ]);
        $post->save();
    }
}
