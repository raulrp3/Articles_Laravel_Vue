<?php

use App\User;
use App\Article;
use App\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        factory(User::class)->create();

        factory(Article::class)->times(20)->create();
        factory(Comment::class)->times(20)->create();

        // $this->call(UserSeeder::class);
    }
}
