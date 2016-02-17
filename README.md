Тестовое задание
=====================

Всем доброго времени суток!

Началось всё с того, что в качестве тестового задания на собеседованиях, я начал просить соискателей реализовать предзагрузчик картинок на JS. Помимо самой предзагрузки, скрипт должен был уметь подставлять fallback-картинку, если нужная картинка не могла быть загружена. Обязательным условием было — использование ES6 Promise.
Затем я подумал: «А почему бы самому не реализовать такой предзагрузчик и не выложить в общее пользование? Да это же еще и отличный повод написать статью на Хабр!».
Собственно, под катом описание логики работы такого предзагрузчика + ссылка на сам предзагрузчик.

### Overview [MultiMarkdownOverview] ##

Для начала, давайте вспомним — что такое промис в JS.

Про промисы
Промис — это, в первую очередь, способ организации асинхронного кода. Хотя и не обязательно асинхронного…
Для создания промиса необходима функция, которая будет выполнена сразу же, после создания промиса.
Наша задача, внутри этой функции, вызвать один из двух методов, передаваемых в эту функцию автоматически — resolve или reject.
Вызовом одного из этих методов, мы говорим промису о статусе задачи: выполнена успешно (resolve) или неудачно (reject).
Делается это для того, чтобы можно было построить цепочку дальнейших действий в случае успешного или не успешного выполнения задачи.

Всем доброго времени суток!

Началось всё с того, что в качестве тестового задания на собеседованиях, я начал просить соискателей реализовать предзагрузчик картинок на JS. Помимо самой предзагрузки, скрипт должен был уметь подставлять fallback-картинку, если нужная картинка не могла быть загружена. Обязательным условием было — использование ES6 Promise.
Затем я подумал: «А почему бы самому не реализовать такой предзагрузчик и не выложить в общее пользование? Да это же еще и отличный повод написать статью на Хабр!».
Собственно, под катом описание логики работы такого предзагрузчика + ссылка на сам предзагрузчик.

[Overview][]Для начала, давайте вспомним — что такое промис в JS.

Про промисы
Промис — это, в первую очередь, способ организации асинхронного кода. Хотя и не обязательно асинхронного…
Для создания промиса необходима функция, которая будет выполнена сразу же, после создания промиса.
Наша задача, внутри этой функции, вызвать один из двух методов, передаваемых в эту функцию автоматически — resolve или reject.
Вызовом одного из этих методов, мы говорим промису о статусе задачи: выполнена успешно (resolve) или неудачно (reject).
Делается это для того, чтобы можно было построить цепочку дальнейших действий в случае успешного или не успешного выполнения задачи.

Всем доброго времени суток!

Началось всё с того, что в качестве тестового задания на собеседованиях, я начал просить соискателей реализовать предзагрузчик картинок на JS. Помимо самой предзагрузки, скрипт должен был уметь подставлять fallback-картинку, если нужная картинка не могла быть загружена. Обязательным условием было — использование ES6 Promise.
Затем я подумал: «А почему бы самому не реализовать такой предзагрузчик и не выложить в общее пользование? Да это же еще и отличный повод написать статью на Хабр!».
Собственно, под катом описание логики работы такого предзагрузчика + ссылка на сам предзагрузчик.

Для начала, давайте вспомним — что такое промис в JS.

Про промисы
Промис — это, в первую очередь, способ организации асинхронного кода. Хотя и не обязательно асинхронного…
Для создания промиса необходима функция, которая будет выполнена сразу же, после создания промиса.
Наша задача, внутри этой функции, вызвать один из двух методов, передаваемых в эту функцию автоматически — resolve или reject.
Вызовом одного из этих методов, мы говорим промису о статусе задачи: выполнена успешно (resolve) или неудачно (reject).
Делается это для того, чтобы можно было построить цепочку дальнейших действий в случае успешного или не успешного выполнения задачи.
