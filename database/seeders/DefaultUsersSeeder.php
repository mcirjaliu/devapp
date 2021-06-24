<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Default user data
     *
     * @var array
     */
    private $defaultUsersData = [
        [
            'name'     => 'Dev User',
            'email'    => 'user@webapp.com',
            'password' => 'userpassword',
        ],
        [
            'name'     => 'Dev User 2',
            'email'    => 'user2@webapp.com',
            'password' => 'userpassword2',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaultUsersData as $defaultUserData) {
            $user = User::create([
                'name'       => $defaultUserData['name'],
                'email'      => $defaultUserData['email'],
                'password'   => Hash::make($defaultUserData['password']),
                'secret_key' => User::generateSecret(),
            ]);
        }

    }
}
