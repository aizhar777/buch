<?php
return [
    'module_name' => 'Сделки',
    'trade_title' => 'Сделка №:ID',
    'trade_edit_title' => 'Изменить сделку №:ID',
    'module_links' => [
        'all' => 'Список сделок',
        'create' => 'Добавить сделку',
        'add_products' => 'Добавить товары\\услуги',
    ],

    'empty' => 'Не заполнено',
    'messages' => [
        'access_denied' => 'В доступе отказано. У вас нет разрешения на эту операцию!',
        'not_enough_rights_to_view' => 'Not enough rights to view',
        'trade_not_delete' => 'Удаление сделки не предусмотренно, вы можете переместить в архив',

        'created' => 'Сделка создана',
        'updated' => 'Сделка обновлена',
        'update' => 'Обновление',
        'created_successfully' => 'Сделка успешно создана!',
        'could_not_create' => 'Не удалось создать сделку',
        'updated_successfully' => 'Сделка успешно обновлена!',
        'could_not_update' => 'Не удалось обновить сделку',
        'quantity_updated' => 'Количество обновлено!',
        'quantity_updated_successfully' => 'Количество успешно обновлено!',
        'quantity_could_not_update' => 'Не удалось обновить количество',

        'unknown_error' => 'Произошла неизвестная ошибка, пожалуйста, попробуйте еще раз позже!',
        //'' => '',

    ],

    'view' => [
        'product_name' => 'Наименование товара\\услуги',
        'product_desc' => 'Описание',
        'product_price' => 'Цена',
        'product_amount' => 'Количество',
        'product_sum' => 'Сумма',
        'ppc' => 'КНП',
        'curator' => 'Ответственный',
        'client' => 'Клиент',
        'payment_is_completed' => 'Оплата произведена',
        'is_not_complete' => 'Не произведена',
        'is_complete' => 'Оплата произведена, закрыл <a href=":LINK"><i class="fa fa-user"></i> :USERNAME </a>',
        'user_id_by_complete' => 'Закрыл пользователь с ID: :ID',
        'created_date' => 'Дата открытия сделки',
        'button_show_trade_products' => 'Показать список товаров\\услуг',
        'button_update_trade_products' => 'Обновить список товаров\\услуг',
        'trade_history' => 'История сделки',
        'back_to_trade' => 'Вернуться в сделку',
        //'' => '',
    ],

    'forms' => [
        'form_title' => 'Форма изменения данных сделки',
        'form_title_create' => 'Форма открытия сделки',
        'input_status_label' => 'Статус',
        'input_status_placeholder' => 'Выбирите статус',
        'input_curator_label' => 'Ответственный',
        'input_curator_placeholder' => 'Выбирите ответственного',
        'input_client_label' => 'Клиент',
        'input_client_placeholder' => 'Выбирите клиента',
        'input_ppc_label' => 'КНП',
        'input_ppc_placeholder' => 'Выбирите КНП',
        //'' => '',
    ],

    'event' => [
        'creation_trade' => 'Открытие сделки № :ID',
        'trade_creator' => 'Сделку открыл (:ID):NAME',
        'user_added_product_title' => 'Добавление товаров\\услуг',
        'user_added_product' => 'Добавил (:ID):NAME',
        'item_list_product' => ':PRODUCT (:COUNT) стоимостью :COST '. config('company.currency'),
        //'' => '',
    ],

    //'' => '',


];