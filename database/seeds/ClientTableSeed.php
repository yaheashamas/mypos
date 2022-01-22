<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['yamen','mohamed'];
        foreach ($clients as $client) {
            Client::create([
                'name' => $client,
                'phone' => 0111111111,
                'address' => "syria"
            ]);
        }
    }
}
