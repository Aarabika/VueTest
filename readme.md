Так как генерация каждой задачи - ресурсозатрантая операция, создание и обновление задач было реализовано при помощи <a href="https://laravel.com/docs/5.5/queues">встроеного механизма очередей laravel</a> на движке database, так как скорость работы очереди нам не принципиальна, а ресурсы да (поэтому не redis и подобные)

Для корректного обновления списка задач в фоне необходимо добавить cron запись на сервер
: * 1 * * * php /path-to-your-project/artisan schedule:run 
