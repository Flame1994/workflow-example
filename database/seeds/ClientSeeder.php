<?php

use App\Client;
use Illuminate\Database\Seeder;

/**
 * @author Ruan Haarhoff <ruan@aptic.com>
 * @since 20200418 Initial creation.
 */
class ClientSeeder extends Seeder
{
    /**
     * Client constants.
     */
    const NUMBER_OF_CLIENT = 100;

    /**
     */
    public function run()
    {
        factory(Client::class, self::NUMBER_OF_CLIENT)->create();
    }
}
