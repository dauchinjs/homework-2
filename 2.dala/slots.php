<?php

$spinPrice = 1;
$money = (int) readline("Insert your money. Keep in mind that one spin is {$spinPrice}eur. ");

echo PHP_EOL . PHP_EOL;
echo "1.Roll";
echo PHP_EOL;
echo "2.Quit";
echo PHP_EOL;

$input = (int) readline("Wanna roll? :) Press 1 || Want to end? :( Press 2 ");

$symbols = ['F' => 1, 'L' => 2, 'O' => 3, 'B'=> 5, '@'=> 10, '*'=> 20, 'S' => 30, '8' => 50, '$' => 75]; // worst->best with its value
function randomSymbol(array $symbols): string {
    $randomValue = floor(mt_rand(0, 1000) / 10);
    if($randomValue <= 3) {
        return $symbols[8];
    }if ($randomValue <= 6) {
        return $symbols[7];
    }if ($randomValue <= 9) {
        return $symbols[6];
    }if ($randomValue <= 13) {
        return $symbols[5];
    }if ($randomValue <= 21) {
        return $symbols[4];
    }if ($randomValue <= 40) {
        return $symbols[3];
    }if ($randomValue <= 50) {
        return $symbols[2];
    }if ($randomValue <= 70) {
        return $symbols[1];
    }
    return $symbols[0];

}

$board = [
    [' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' '],
];

$combinations = [
    //Horizontal
    [[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]],
    [[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]],
    [[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]],

    //across up and down
    [[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]],
    [[2, 0], [1, 1], [0, 2], [1, 3], [2, 4]],

    //across down ->
    [[0, 0], [1, 1], [2, 2], [2, 3], [2, 4]],

    //across up ->
    [[2, 0], [1, 1], [0, 2], [0, 3], [0, 4]],

    //-> across down
    [[0, 0], [0, 1], [0, 2], [1, 3], [2, 4]],

    //-> across up
    [[2, 0], [2, 1], [2, 2], [1, 3], [0, 4]],

    //zigzag
    [[1, 0], [0, 1], [1, 2], [0, 3], [1, 4]],
    [[2, 0], [1, 1], [2, 2], [1, 3], [2, 4]],
    [[0, 0], [1, 1], [0, 2], [1, 3], [0, 4]],
    [[1, 0], [2, 1], [1, 2], [2, 3], [1, 4]],
];

function displayBoard(array $board) {
    echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]} | {$board[0][3]} | {$board[0][4]} \n";
    echo "---+---+---+---+---\n";
    echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]} | {$board[1][3]} | {$board[1][4]} \n";
    echo "---+---+---+---+---\n";
    echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]} | {$board[2][3]} | {$board[2][4]} \n";
}
if($input == 2) {
    exit;
} else if($input > 2 || $input < 1) {
    echo "Invalid input";
    echo PHP_EOL;
    exit;
}

while($money >= $spinPrice) {

    for($i = 0; $i <= 15; $i++) {
        for($j = 0; $j <= 15; $j++) {
            $board[$i][$j] = randomSymbol(array_keys($symbols));
        }
    }
    displayBoard($board);
    echo PHP_EOL;

    $getPayed = 0;
    $money -= $spinPrice;

    foreach($combinations as $combination) {
        $combinationCounter = 0;

        [$symbolX, $symbolY] = $combination[0];
        $symbol = $board[$symbolX][$symbolY];

        foreach($combination as $position) {
            [$x, $y] = $position;
            if($board[$x][$y] !== $symbol) {
                break;
            }
            $combinationCounter++;
        }
        if($combinationCounter >= 3) {
            $amount = $symbols[$symbol] * $combinationCounter;
            echo "You won {$amount}eur!";
            echo PHP_EOL;
            $money += $symbols[$symbol] * $combinationCounter;
        }
    }

    echo "Your balance: {$money} eur";
    echo PHP_EOL;

    echo "1.Roll";
    echo PHP_EOL;
    echo "2.Quit";
    echo PHP_EOL;
    $input = readline("Roll or quit? ");
    if($input != 1) {
        exit;
    }
}
