<?php

use Illuminate\Database\Seeder;

class PPCTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {

        $ser = \File::get(__DIR__.'/knp.txt');
        $uns = unserialize($ser);
        try {
            foreach ($uns as $value) {
                DB::table('ppc')->insert([
                    'code' => (string)$value[0],
                    'description' => $value[1],
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
        }catch (\Exception $e){
            throw $e;
        }
    }
}
