<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (User::where('type', 'admin')->count()) {
            return;
        }

        User::create([
            'name' => "clb",
            'email' => 'admin@clb.com',
            'type' => 'admin',
            'phone'=> '655555555',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);
    }
}
