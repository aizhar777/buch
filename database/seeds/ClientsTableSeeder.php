<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ru_RU');
        $created_clients = 0;
        for ($i=0; $i < 12; $i++){
            \DB::beginTransaction();
            $client = \App\Client::create([
                'name' => $faker->name,
                'email' => random_int(10,100).random_int(10,100).random_int(10,100).$faker->email,
                'phone' => $faker->phoneNumber,
                'curator' => null,
            ]);

            if($client instanceof \App\Client){
                $requisite = \App\Requisite::create([
                    'legal_name' => $faker->company,
                    'bank' => 'АО Новый Интернет Банк',
                    'iik' => $this->getIIK(),
                    'bin' => $this->getBIN(),
                    'cbe' => 19,
                    'relation_id' => $client->id,
                    'relation_type' => $client::TYPE,
                ]);
                if($requisite instanceof \App\Requisite){
                    $created_clients += 1;
                    \DB::commit();
                }else \DB::rollBack();
            }else \DB::rollBack();
        }

        echo 'created to ' . $created_clients . ' clients'.PHP_EOL;
    }

    public function getIIK()
    {
        $code = ['KZ','RU'];
        $iik = '';
        for($i=0; $i < 18; $i++){
            $iik .= rand(0,9);
        }

        return $code[rand(0,1)].$iik;
    }

    public function getBIN()
    {
        return 'BINNIBKZ';
    }
}
