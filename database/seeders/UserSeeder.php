<?php

namespace Database\Seeders;

use App\Models\AuthorModel;
use App\Models\EditorModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Author;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Author = [
            'fullname' => 'Author',
            'username' => 'author',
            'password' => Hash::make('password'),
            'role' => 'author',
            'phone_number' => '082278563108'
        ];
        $editor = [
            'fullname' => 'editor',
            'username' => 'editor',
            'password' => Hash::make('password'),
            'role' => 'editor',
        ];
        $createAuthorUser = User::create([
            'fullname' =>$Author['fullname'],
            'username' =>$Author['username'],
            'password' =>$Author['password'],
            'role' =>$Author['role'],
        ]);

        $createAuthorUser->assignRole('author');

        $Author = AuthorModel::create([
            'user_id' => $createAuthorUser->id,
            'phone_number'=> $Author['phone_number'],
        ]);

        $createEditorUser = User::create([
            'fullname' =>$editor['fullname'],
            'username' =>$editor['username'],
            'password' =>$editor['password'],
            'role' =>$editor['role'],
        ]);


        $createEditorUser->assignRole('editor');
        $editor = EditorModel::create([
            'user_id' => $createEditorUser->id,
        ]);




    }
}
