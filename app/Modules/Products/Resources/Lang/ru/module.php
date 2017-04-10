<?php
return [
    'module_name' => 'Товары\\Услуги',
    'title_product' => 'Товар :NAME',
    'title_service' => 'Услуга :NAME',
    'edit_title' => 'Изменение :NAME',
    'module_links' => [
        'all' => 'Список Товаров\\Услуг',
        'create' => 'Добавить Товар\\Услугу',
    ],
    'is_service' => 'Услуга',
    'is_product' => 'Товар',

    'empty' => 'Не заполнено',
    'none' => 'Отсутствует',
    'list' => 'Список',

    'view' => [
        'id' => '№',
        'name' => 'Название',
        'slug' => 'Альт. название',
        'description' => 'Описание',
        'price' => 'Цена',
        'cost' => 'Себестоимость',
        'as_service' => 'Услуга',
        'unit' => 'Ед. Измерения',
        'balance' => 'Баланс',
        'stock' => 'Склад',
        'subdivision' => 'Подразделение',
        'date' => 'Дата',
        'action' => 'Действия',
        //'' => '',
    ],

    'form' => [
        'create_form_label' => 'Форма создания Товара\\Услуги',
        'edit_form_label' => 'Форма изменения Товара\\Услуги',
        'name' => 'Название',
        'slug' => 'Альт. название',
        'description' => 'Описание',
        'price' => 'Цена',
        'cost' => 'Себестоимость',
        'unit' => 'Ед. Измерения',
        'as_service' => 'Услуга',
        'balance' => 'Баланс',
        'stock' => 'Склад',
        'subdivision' => 'Подразделение',
        'is_a_service_label' => 'Это услуга',
        //'' => '',
    ],
    'messages' => [
        'access_denied' => 'В доступе отказано. У вас нет разрешения на эту операцию!',
        'not_enough_rights_to_view' => 'У вас нет разрешения на эту операцию!',
        'created' => 'Подразделение создано',
        'updated' => 'Подразделение обновлено',
        'update' => 'Обновление',
        'created_successfully' => 'Товар\\Услуга успешно создано!',
        'product_created_successfully' => 'Товар успешно создан!',
        'service_created_successfully' => 'Услуга успешно создана!',
        'could_not_create' => 'Не удалось создать Товар\\Услугу',
        'product_could_not_create' => 'Не удалось создать Товар',
        'service_could_not_create' => 'Не удалось создать Услугу',
        'updated_successfully' => 'Товар\\Услуга успешно обновлено!',
        'could_not_update' => 'Не удалось обновить Товар\\Услугу',
        'deleted_successfully' => 'Товар\\Услуга успешно удалено!',
        'could_not_delete' => 'Не удалось удалить Товар\\Услугу',

        'not_found' => 'Товары\\Услуги отсутствуют',
    ],

    'ajax' => [
        'select_products' => 'Список товаров\\услуг',
        'price' => 'цена',
        'products_title' => 'Товары\\Услуги',
        'help_block_notice' => 'Пожалуйста, выберите товары или услуги, а затем измените их количество.'
    ]
];