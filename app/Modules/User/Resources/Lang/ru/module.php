<?php
return [
    'module_name' => 'Пользователи',
    'module_links' => [
        'all' => 'Список пользователей',
        'create' => 'Добавить пользователя',
        'roles' => 'Группы пользователей',
        'roles_add' => 'Добавить группу',
        'roles_edit' => 'Редактировать группу',
        'permissions' => 'Разрешения',
    ],
    'empty' => 'Не заполнено',
    'total' => 'Всего: :total',
    'list' => 'Список',
    'role' => 'Группа',
    'roles' => 'Группы',
    'permissions' => 'Разрешения',
    'name' => 'Имя',
    'email' => 'Почта',
    'date' => 'Дата',
    'action' => 'Действия',
    'view_profile' => 'Посмотреть профиль :Name',
    'info' => 'Информация',
    'users_not_isset' => 'Пользователи отсутствуют',
    'user' => 'Пользователь',
    'create_user' => 'Создать пользователя',

    //Messages
    'messages' => [
        'access_denied' => 'В доступе отказано. У вас нет разрешения на эту операцию!',

        'user' => [
            'created' => 'Пользователь создан',
            'created_successfully' => 'Пользователь успешно создан!',
            'could_not_create' => 'Не удалось создать пользователя',
            'image_updated_successfully' => 'Ваше фото успешно обновлено',
            'image_could_not_updated' => 'Не удалось обновить фото',
            'image_uploaded_successfully' => 'Ваше фото успешно загружено',
            'image_could_not_upload' => 'Не удалось загрузить ваше фото',
            'user_role_updated' => 'Роли пользователя были обновлены'
        ],

        'role' => [
            'created' => 'Новая группа создана',
            'updated' => 'Обновлено',
            'created_successfully' => 'Группа :name успешно создана!',
            'updated_successfully' => 'Группа :name успешно обновлена!',
            'deleted_successfully' => 'Группа :name успешно удалена',
            'could_not_create' => 'Не удалось создать группу :name',
            'could_not_updated' => 'Не удалось изменить группу :name',
            'could_not_deleted' => 'Не удалось удалить группу :name',

        ],

        'permission' => [
            'updated_for_role' => 'Разрешения успешно обновлены для группы :name',
            'could_not_updated_for_role' => 'Не удалось изменить разрешения для группы :name',
        ],
    ],
];
