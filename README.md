## API для игры в шахматы
Для создания API использовался фреймворк Laravel.
### Как играть

**Статус игры**

GET /status

Возвращает информацию о текущей партии. Содержит следующую информацию:
1) Текущий игрок.
2) Закончена ли игра.
3) Положение фигур на доске.
4) Победитель (если игра закончена).


Пример ответа:
```json
{
    "currentPlayer": "black",
    "isOver": true,
    "board": [
                [ "0", "A", "B", "C", "D", "E", "F", "G", "H"],
                ["1", "WR", "WK", "WB", "WQ", "__", "WB", "WK", "WR"],
                ["2", "WP", "WP", "WP", "WP", "__", "WP", "WP", "WP"],
                ["3", "__", "__", "__", "__", "__", "__", "__", "__"],
                ["4", "__", "__", "__", "__", "__", "__", "__", "__"],
                ["5", "__", "__", "__", "__", "WKing", "__", "__", "__"],
                ["6", "BP","__", "__", "BQ", "__", "BK", "__", "__"],
                ["7", "__", "BP", "BP", "__", "__", "BP", "BP", "BP"],
                ["8", "BR", "BK", "BB", "__", "BKing", "BB", "__", "BR"]
              ],
    "winner": "black"
}
```

**Создание новой игры**

POST /new_game

Создается новая игра, результаты старой партии теряются.

**Ход**

POST /make_move

Пример запроса:
```json
{
    "figureCoordinates": "A2",
    "destination": "A3",
    "transformationModificator": "Q"
}
```

В теле запроса передается JSON. Есть два обязательных параметра "figureCoordinates" и "destination". Первый параметр - координаты фигуры, которой ходят, второй параметр - координаты квадрата, на котором эта фигура должна оказаться. Координаты задаются строкой, состоящей из одной латинской буквы от "A" до "H" и цифры от 1 до 8.

Также есть не обязательный параметр - "transformationModificator", он обозначает фигуру, в которую превратится пешка при переходе на последнюю горизонталь, если его не указать, то пешка превратится в королеву. Возможные значения параметра: "Q" - королева, "R" - ладья, "K" - конь, "B" - слон.

Ответ

После хода возвращается статус игры:
1) Окончена ли игра.
2) Какая фигура была взята.
3) Расположение фигур на доске.
4) Текущий игрок.

Пример ответа
```json
{
    "isOver": false,
    "taken": "",
    "board": [
        [ "0", "A", "B", "C", "D", "E", "F", "G", "H"],
        [ "1", "WR", "WK", "WB", "WQ", "WKing", "WB", "WK", "WR"],
        [ "2", "__", "WP", "WP", "WP", "WP", "WP", "WP", "WP"],
        [ "3", "WP", "__", "__", "__", "__", "__", "__", "__"],
        [ "4", "__", "__", "__", "__", "__", "__", "__", "__"],
        [ "5", "__", "__", "__", "__", "__", "__", "__", "__"],
        [ "6", "__", "__", "__", "__", "__", "__", "__", "__"],
        [ "7", "BP", "BP", "BP", "BP", "BP", "BP", "BP", "BP"],
        [ "8", "BR", "BK", "BB", "BQ", "BKing", "BB", "BK", "BR"]
    ],
    "currentPlayer": "black"
}
```

Если поставлен мат, то будет возвращаться следующее сообщение:

```json
{
    "message": "Game is over, black wins!"
}
```

**Особые ходы**

Любые ходы, в том числе взятие на проходе и рокировка задаются координатами фигуры и координатами квадрата, куда она должна попасть. Рокировка и взятие на проходе будут распознаны автоматически. 

### Запуск
Для запуска нужно выполнить команду
```
php artisan serve
```

### Запуск тестов
Для запуска тестов нужно выполнить команду
```
vendor/bin/phpunit
```

