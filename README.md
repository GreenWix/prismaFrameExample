## prismaFrameExample

Данный репозиторий - пример проекта, использующего [prismaFrame 1.0.1](https://github.com/GreenWix/prismaFrame/releases/tag/v0.2.1)

Вы можете его использовать как шаблон для своих проектов, использующих [prismaFrame](https://github.com/GreenWix/prismaFrame)

![](https://sun9-62.userapi.com/7EiEbFv__8-aj7fPLSeFxmMp3YOv9QkuwvrnsA/IeJQXrmqlvY.jpg)

---

## Установка

```shell script
git clone https://github.com/GreenWix/prismaFrameExample.git
cd prismaFrameExample
composer update
```

## Запуск

```shell script
./rr serve -v -d 
```
По умолчанию roadrunner запустится на 0.0.0.0:8080 (порт можно настроить в ```.rr.yaml```)

Для проверки примера можете перейти на http://127.0.0.1:8080/test.rar?v=0.0.1&da=1&db=2

---

## Roadrunner

Всю информацию касательно [roadrunner](https://github.com/spiral/roadrunner) Вы можете прочитать на официальном сайте https://roadrunner.dev/

---

## Как изменить namespace?

Изменить namespace можно, изменив в ```composer.json``` имя поля ```"example\\"``` на ваше значение (не забудьте также у файлов, лежащих в src, заменить namespace)
```json
{
  "example\\": "src/"
}
```
После изменения файла ```composer.json``` пропишите в консоли следующую команду
```shell script
composer update
```