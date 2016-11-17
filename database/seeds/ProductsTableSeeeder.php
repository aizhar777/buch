<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ru_RU');
        $stock = 1; //\App\Stock::firstOrFail()->id;
        $subdivision = 1; //\App\Subdivision::firstOrFail()->id;

        for ($i = 0; $i < 10; $i++) {
            foreach ($this->getProductsArray() as $product){
                \App\Product::create($product);
            }

/*            $service = rand(0, 1);
            \App\Product::create([
                'name' => $faker->title,
                'description' => $faker->text(rand(130, 640)),
                'price' => $faker->randomFloat(null, 5000, 10000),
                'cost' => $faker->randomFloat(null, null, 3000),
                'гтше' => (rand(0, 1)) ? "Шт." : "Ед.",
                'is_service' => $service,
                'balance' => $service ? 1 : rand(3, 100),
                'stock_id' => $stock,
                'subdivision_id' => $subdivision,
            ]);*/
        }
    }

    public function getProductsArray()
    {
        return [
            [
                "name" => "Переустановка системы",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 6500.5,
                "cost" => 4000.5,
                "unit" => "ПК",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Установка ОС",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 120000.5,
                "cost" => 90000.5,
                "unit" => "ПК",
                "is_service" => 0,
                "balance" => 13,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Оптимизация системы",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 6500.5,
                "cost" => 5250.9,
                "unit" => "час",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Чистка реестра",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 5101.4,
                "cost" => 1505.8,
                "unit" => "час.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Обновление системы",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 12060.4,
                "cost" => 7080.08,
                "unit" => "ед.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Чистка от вирусов",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 7736.5,
                "cost" => 1763.45,
                "unit" => "час.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Аудит Инф. Безопасности",
                "description" => "Qui qui aspernatur in temporibus nesciunt. Iure autem eos aliquid commodi. Iure cum et commodi voluptatem velit illum veniam.",
                "price" => 110000.5,
                "cost" => 70500.846,
                "unit" => "раз.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Установка драйверов",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 3000.5,
                "cost" => 1000.2,
                "unit" => "час.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "Стандартное обслуживание",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 18000.5,
                "cost" => 10000.3,
                "unit" => "мес.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
            [
                "name" => "VIP обслуживание",
                "description" => "Ea quibusdam quam beatae ea vel dolor necessitatibus et. Est eum enim saepe et voluptatem nihil.",
                "price" => 35000.5,
                "cost" => 20000.45,
                "unit" => "мес.",
                "is_service" => 1,
                "balance" => 1,
                "stock_id" => 1,
                "subdivision_id" => 1,
            ],
        ];
    }
}
