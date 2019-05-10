<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
//insert into evaluations (user_id, stock_code, evaluate_date, comment, point, next_check) VALUES ("1", "3902",datetime('now'), "test", "60", "2019/05/08");
//insert into stocks (stock_code, name, created_at) VALUES ("3902", "MDV", 2019/04/01);