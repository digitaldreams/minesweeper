# minesweeper
Minesweeper is a single-player puzzle computer game. The objective of the game is to clear a rectangular board containing hidden "mines" or bombs without detonating any of them, with help from clues about the number of neighboring mines in each field

## How to Run

```php
cd path/to/project
composer install
composer dump-autoload
php index.php
```
<img src="https://i.ibb.co/HzQBjgf/Screenshot-2019-07-25-at-10-16-30-AM.png" alt="Screenshot-2019-07-25-at-10-16-30-AM" border="0">

Now put Row and Column Number you want to hit
for example ROw 5, Column 6 

## Specifications:

- This application runs in Cli (no web)
- generates a minesweeper board (Row X Columns) e.g (20x30)
- puts down a certain number of mines (25) on random locations
- game starts
- asks for input (two numbers): row & column (the coordinates that you want to "click")
- once the input is given, the output should print the current status of the board, displaying by default/non-clicked `_`
- the "clicked cell" will contain the number of neighboring mines that it has around
- if its a boom it will contain an `X` and the game ends
- you can win if there are only mines left
