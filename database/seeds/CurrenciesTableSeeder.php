<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'USDJPY',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'GBPJPY',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'GBPUSD',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'EURJPY',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'EURUSD',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'AUDJPY',
            'created_at' => today(),
        ]);
        DB::table('currencies')->insert([
            'active' => 1,
            'user_id' => '0',
            'currency' => 'AUDUSD',
            'created_at' => today(),
        ]);
    }
}
