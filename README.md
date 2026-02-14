## База данных (TiDB Cloud)

- **Хост:** `gateway01.eu-central-1.prod.aws.tidbcloud.com`
- **Порт:** `4000`
- **База данных:** `test`
- **Пользователь:** `4CMADLLGYJUWZn9.root`
- **Пароль:** `PsGg48fxzSQrKhYE`

**Таблицы в БД:** 
`failed_jobs`
`incomes`
`migrations`
`orders`
`password_resets`
`personal_access_tokens`
`sales`
`stocks`
`users`

## Инструкция по запуску
1. Склонируйте репозиторий.
2. Установите зависимости: `composer install`.
3. Настройте `.env` (данные подключения к БД указаны выше).
4. Запустите Octane: `php artisan octane:start`.


## Инструкция по запуску для локльной базы
1. Склонируйте репозиторий.
2. Установите зависимости: `composer install`.
3. Настройте `.env` (свои данные к подключению бд).
4. Выполните миграцию `php artisan migrate`
5. Запустите Octane: `php artisan octane:start`.


PS: Задание было выполнено без Docker из-за проблем с wsl панелью, надеюсь это не будет критично, 
раньше пользовался docker, просто он часто вызывал проблемы, готов обучиться всему у вас