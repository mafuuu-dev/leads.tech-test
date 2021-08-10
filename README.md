### **Тестовое задание Leads.Tech**

Написать на PHP простую систему обработки клиентских заявок.

Использовать уже готовый генератор заявок:
https://github.com/vladimir163/lead-generator

#### **Описание:**

Необходимо обработать 10 000 заявок не дольше чем за 10 минут.
Процесс обработки одной заявки:
Обработчик засыпает на 2 секунды (эмулируем тяжелую операцию)
Добавляет запись в файл log.txt об успешной обработке в формате: 
lead_id | lead_category | current_datetime

#### **Требования к системе:**
Если обработка заявок определенной категории невозможна, остальные должны обрабатываться беспрепятственно.

#### **Технические требования:**
- Объектно-ориентированный подход, интерфейсы
- Нельзя использовать PHP-фреймворки
- Допускается использование подключаемых библиотек.
- Docker для запуска проекта
- Type Hinting, PSR
- Залить код в публичный Git-репозиторий

#### **Инструкция по запуску:**
- устанавливаем Docker
- устанавливаем Docker-Compose
- cd <path-to-leads.tech-test>
- docker-compose up -d && docker-compose logs -f --tail=1

#### **Просмотр файла log.txt:**
- docker exec -ti leadstech-test_php_1 sh
- tail -f storage/log.txt

#### **Примечание:**
После выполнения программы в лог контейнера выводится следующая информация:
- исключенные категории
- время выполнения