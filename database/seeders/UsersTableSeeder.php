<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =  User::create(
            [
                'name' => 'Assem al Jimzawi',
                'email' => 'assem.cs.90@gmail.com',
                'password'=>bcrypt('0000123assem'),
                'admin'=> 1
            ]
        );

        Profile::create(
            [
                'user_id' => $user->id,
                'avatar'=> 'uploads/avatar/16253500613348.jpg',
                'about' => 'fgdgdfgdf dfgdfg dfgdf  flg;kjdlgdfklgjdfklgjdflg ncb,mbcvb,nmdd.vbd',
                'facebook'=>'facebook.com',
                'youtube'=> 'youtube.com'
            ]
        );
    }
}
