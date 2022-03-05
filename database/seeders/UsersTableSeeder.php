<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mktusers')->truncate();

        $slug = 'Super Admin'.' '.'PS0215';
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'info@keener.com',
            'password' => Hash::make('admin123'),
            'staffId'   =>  'PS0215',
            'status'    => true,
            'slug'  => Str::of($slug)->slug('-'),
        ]);

        $role = Role::where('name', 'admin')->first();

        $user->attachRole($role);
    }
}
