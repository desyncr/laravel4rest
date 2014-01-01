<?php
class UsersTableSeeder extends Seeder {
    public function run() {

        DB::table('users')->delete();
        User::create(
            array('email' => 'test@example.com', 'password' => Hash::make('test'), 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
        User::create(
            array('email' => 'dario@example.com', 'password' => Hash::make('test'), 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
        User::create(
            array('email' => 'user@example.com', 'password' => Hash::make('test'), 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
    }

}
