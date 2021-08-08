### **Тестовое задание Leads.Tech**

Инструкция по запуску:
1. устанавливаем Docker
2. устанавливаем Docker-Compose
3. cd <path-to-leads.tech-test>
4. docker-compose up -d && docker-compose logs -f --tail=1

Просмотр файла log.txt:
1. docker exec -ti leadstech-test_php_1 sh
2. tail -f storage/log.txt