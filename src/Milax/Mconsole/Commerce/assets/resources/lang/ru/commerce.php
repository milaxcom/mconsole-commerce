<?php

return [
    'menu' => [
        'index' => 'Коммерция',
        'brands' => 'Производители',
        'orders' => 'Заказы',
        'categories' => 'Категории',
        'products' => 'Товары',
        'delivery' => 'Способы доставки',
        'discounts' => 'Скидки',
        'promocodes' => 'Промокоды',
        'payment' => 'Способы оплаты',
    ],
    'module' => [
        'description' => 'E-shop solutions',
    ],
    'delivery' => [
        'tabs' => [
            'main' => 'Основное',
        ],
        'form' => [
            'name' => 'Название',
            'description' => 'Описание',
            'cost' => 'Стоимость',
        ],
    ],
    'orders' => [
        'caption' => 'Заказы',
        'order' => 'Заказ #:identifier',
        'cart' => [
            'product' => 'Товар',
            'quantity' => 'Количество',
            'price' => 'Цена',
            'total' => 'Итого',
        ],
        'tabs' => [
            'status' => 'Статус',
            'delivery' => 'Информация о доставке',
            'cart' => 'Корзина',
            'total' => 'Итого',
        ],
        'form' => [
            'status' => 'Статус',
            'email' => 'Эл. почта',
            'change_status' => 'Изменить статус заказа',
            'comment' => 'Комментарий оператора (скрыт для клиента)',
        ],
        'table' => [
            'identifier' => 'Заказ N',
            'total' => 'Итого',
            'status' => 'Статус',
            'delivery' => 'Доставка',
            'payment' => 'Способ оплаты',
        ],
    ],
    'brands' => [
        'caption' => 'Производители',
        'table' => [
            'updated' => 'Обновлено',
            'slug' => 'Slug',
            'name' => 'Название',
            'products' => 'Продукты',
        ],
        'tabs' => [
            'main' => 'Основное',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Название',
            'description' => 'Описание',
        ],
    ],
    'categories' => [
        'caption' => 'Категории',
        'table' => [
            'updated' => 'Обновлено',
            'slug' => 'Slug',
            'name' => 'Название',
        ],
        'tabs' => [
            'main' => 'Основное',
            'additional' => 'Дополнительное',
            'relationships' => 'Связи',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Название',
            'description' => 'Описание',
            'cover' => 'Обложка',
            'category_id' => 'Родительская категория',
            'parent' => 'Родитель',
            'children' => 'Потомок',
        ],
    ],
    'products' => [
        'caption' => 'Товары',
        'table' => [
            'updated' => 'Обновлено',
            'article' => 'Артикул',
            'slug' => 'Slug',
            'name' => 'Название',
            'brand' => 'Производитель',
            'quantity' => 'Количество',
        ],
        'tabs' => [
            'main' => 'Основное',
            'additional' => 'Дополнительное',
        ],
        'form' => [
            'brand' => 'Производитель',
            'slug' => 'Slug',
            'name' => 'Название',
            'article' => 'Артикул',
            'price' => 'Цена',
            'inventory' => 'Наличие',
            'quantity' => 'Доступное количество',
            'discount_price' => 'Цена со скидкой',
            'increase_price' => 'Наценка (%)',
            'decrease_price' => 'Уценка (%)',
            'description' => 'Описание',
            'cover' => 'Обложка',
            'categories' => 'Категории',
            'gallery' => 'Галерея',
            'in_stock' => 'В наличии',
            'of_stock' => 'Нет в наличии',
            'on_request' => 'Под заказ',
            'new' => 'Пометить как новый',
            'brand' => 'Производитель',
        ],
        'categories' => [
            'placeholder' => 'Товар должен принадлежать хотя бы к одной категории',
        ],
        'info' => [
            'category' => 'Нет доступных категорий. Пожалуйста, создайте новую категорию.',
        ],
        'config' => [
            'tables' => [
                'specifications' => 'Характеристики',
            ],
            'lists' => [
                'composition' => 'Состав (по одному на строчку)',
                'advantages' => 'Преимущества (по одному на строчку)',
            ],
        ],
    ],
    'discounts' => [
        'tabs' => [
            'main' => 'Основное',
            'discounts' => 'Таблица скидок',
        ],
        'table' => [
            'nodiscounts' => 'Нет скидок',
        ],
        'form' => [
            'accumulative' => 'Накопительная',
            'name' => 'Название',
            'description' => 'Описание',
            'discounts' => 'Табоица скидок',
            'discount' => 'Скидка',
            'sum' => 'Итого',
            'discount' => 'Скидка в процентах',
            'remove' => 'Удалить',
            'append' => 'Добавить скидку',
        ],
    ],
    'promocodes' => [
        'tabs' => [
            'main' => 'Основное',
            'additional' => 'Дополнительное',
        ],
        'form' => [
            'code' => 'Код',
            'type' => 'Тип',
            'discount' => 'Скидка',
            'amount' => 'Количество (в процентах или в валюте)',
            'one_off' => 'Одноразовый',
            'started_at' => 'Дата начала действия промокода',
            'expired_at' => 'Дата завершения действия промокода',
        ],
        'type' => [
            'percent' => 'Проценты',
            'amount' => 'Количество',
        ],
    ],
    'payment' => [
        'tabs' => [
            'main' => 'Основное',
            'settings' => 'Настройки',
        ],
        'table' => [
            //
        ],
        'form' => [
            'type' => 'Платежная система',
            'name' => 'Название',
            'description' => 'Описание',
            'commission' => 'Коммиссия',
            'commission_type' => 'Тип коммисии',
        ],
        'robokassa' => [
            'login' => 'Идентификатор магазина',
            'password1' => 'Пароль #1',
            'password2' => 'Пароль #2',
            'robochecks' => 'Поддержка Робочеков',
            'sno' => 'Система налогообложения',
        ],
    ],
    'settings' => [
        'group' => [
            'name' => 'Коммерция',
        ],
        'shop' => [
            'url' => 'Адрес магазина',
            'enabled' => 'Магазин включен',
            'decrease_price' => 'Глобальная уценка (%)',
            'increase_price' => 'Глобальная наценка (%)',
            'guests' => 'Гости могут делать заказы',
            'message' => 'Сообщение дня',
            'show_empty_categories' => 'Отображать пустые категории',
            'notifications_email' => 'Эл. адрес для уведомлений',
        ],
        'category' => [
            'cover' => 'Категории с обложкой',
        ],
        'product' => [
            'cover' => 'Товар с обложкой',
            'gallery' => 'Товар с галереей',
        ],
    ],
];
