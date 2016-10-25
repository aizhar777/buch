<?php

use Illuminate\Database\Seeder;

class TradeStatusSeeeder extends Seeder
{
    /**
     * @var array $allStatuses
     */
    public $allStatuses = [
        [
            'name' => 'Открытие сделки',
            'slug' => 'is_open',
            'description' => 'Открытие сделки',
            'level' => 0
        ],
        [
            'name' => 'Поставка',
            'slug' => 'delivery',
            'description' => 'Поставка',
            'level' => 1
        ],
        [
            'name' => 'Выполнено',
            'slug' => 'commitments_fulfilled',
            'description' => 'Выполнено',
            'level' => 2
        ],
        [
            'name' => 'Подписание',
            'slug' => 'signing',
            'description' => 'Подписание актов выполненных работ',
            'level' => 3
        ],
        [
            'name' => 'Ожидается оплата',
            'slug' => 'anticipated_payment',
            'description' => 'Ожидается оплата',
            'level' => 4
        ],
        [
            'name' => 'Оплачено',
            'slug' => 'paid',
            'description' => 'Оплачено',
            'level' => 5
        ],
        [
            'name' => 'В архиве',
            'slug' => 'stored_in_the_archive',
            'description' => 'Оплачено',
            'level' => 6
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (is_array($this->allStatuses)){
            foreach ($this->allStatuses as $status){
                $statusModel = \App\TradeStatus::create($status);
                echo 'Created the status of "' . $statusModel->slug . '"'.PHP_EOL;
            }
        }else{
            echo 'Error: Missing array status';
        }
    }
}
