<?php

use Illuminate\Database\Seeder;

/**
 * @author Ruan Haarhoff <ruan@aptic.com>
 * @since 20200418 Initial creation.
 */
class DatabaseSeeder extends Seeder
{
    /**
     */
    public function run()
    {
        $this->call(ClientSeeder::class);
    }
}
