<?php

use Illuminate\Database\Seeder;

class TradeStatusSeeeder extends Seeder
{
    /**
     * @var array $allStatuses
     */
    public $allStatuses = [
        [
            'name' => 'Заявка',
            'slug' => 'request',
            'description' => 'Заявка для сделки',
            'level' => 0
        ],
        [
            'name' => 'Открытие сделки',
            'slug' => 'is_open',
            'description' => 'Открытие сделки',
            'level' => 10
        ],
        [
            'name' => 'В обработке',
            'slug' => 'in_progress',
            'description' => 'Находится в обработке',
            'level' => 20
        ],
        [
            'name' => 'Обработан',
            'slug' => 'processed',
            'description' => 'Сделка обработана',
            'level' => 40
        ],
        [
            'name' => 'Договор, Счет',
            'slug' => 'contract_account',
            'description' => 'Подписание договоров, и выставление счетов.',
            'level' => 60
        ],
        [
            'name' => 'Оплата, выполнение',
            'slug' => 'payment_execution',
            'description' => 'Оплата и выполнение всех обязательств',
            'level' => 80
        ],
        [
            'name' => 'Документы, Закрытие',
            'slug' => 'documents_closing',
            'description' => 'Завершение сделки, подписание документов.',
            'level' => 100
        ],
        [
            'name' => 'Закрыть',
            'slug' => 'close',
            'description' => 'Закрыть сделку',
            'level' => 101
        ],
        [
            'name' => 'В архиве',
            'slug' => 'stored_in_the_archive',
            'description' => 'Все обязательства выполнены, находится в архиве',
            'level' => 110
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
