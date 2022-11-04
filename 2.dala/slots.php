<?php

//slot machine, kaut kada naudas summa, eksiste slotu mashinas bilde.
// katrs simbols ir uzvaras daudzums. nospied roll vai kko.
// basically slot machine. simboli izmetas random. kkadi simboli var but biezak/retak
//minuss nauda par griezienu. ir kkads koeficients a*0.5 b*1 c*1.5 utt.
//kkads laukums 3x5. uzvaras linijas = briva izvele.
$money = [];
$spinPrice = 1;
$insertedMoney = (int) readline("Insert your money. Keep in mind that one spin is {$spinPrice}eur. ");
$money = $insertedMoney;
echo PHP_EOL . PHP_EOL;
echo "1.Roll";
echo PHP_EOL;
echo "2.Quit";
echo PHP_EOL;
$input = readline("Wanna roll? :) Press 1 || Want to end? :( Press 2 ");


$symbols = ['F', 'L', 'O', 'B', '@', '*', 'S', '8', '$']; // worst->best
function randomSymbol($symbols) {
    $randomValue = floor(mt_rand(0, 1000) / 10);
    if($randomValue <= 3) {
        return $symbols[8];
    } else if ($randomValue <= 5) {
        return $symbols[7];
    } else if ($randomValue <= 7) {
        return $symbols[6];
    } else if ($randomValue <= 10) {
        return $symbols[5];
    } else if ($randomValue <= 21) {
        return $symbols[4];
    } else if ($randomValue <= 40) {
        return $symbols[3];
    } else if ($randomValue <= 50) {
        return $symbols[2];
    } else if ($randomValue <= 70) {
        return $symbols[1];
    } else {
        return $symbols[0];
    }
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

if($input == 1) {
    while($money > $spinPrice) {


        for($i = 0; $i <= 15; $i++) {
            for($j = 0; $j <= 15; $j++) {
                $board[$i][$j] = randomSymbol($symbols);
            }
        }
        displayBoard($board);
        echo PHP_EOL;

        $getPayed = 0;
        if($board == $combinations) {
            for($i = 0; $i <= 15; $i++) {
                for ($j = 0; $j <= 15; $j++) {
                    foreach($combinations as $combination) {
                        $combinationCounter = 0;

                        foreach($combination as $position) {
                            [$i, $j] = $position;
                            if($board[$i][$j] !== $symbols) {
                                break;
                            }
                            $combinationCounter++;
                        }

                        if($combinationCounter == 5) {
                            if($symbols[0]) {
                                $getPayed = 1;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[1]) {
                                $getPayed = 2;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[2]) {
                                $getPayed = 5;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[3]) {
                                $getPayed = 7;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[4]) {
                                $getPayed = 10;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[5]) {
                                $getPayed = 15;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[6]) {
                                $getPayed = 25;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[7]) {
                                $getPayed = 50;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            } else if($symbols[8]) {
                                $getPayed = 100;
                                $money = $money + $getPayed;
                                echo "You have won {$getPayed}eur.";
                            }
                        }
                    }
                }
            }
        }


        $money = $money - $spinPrice;
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
} else if($input == 2) {
    exit;
} else {
    echo "Invalid input";
    echo PHP_EOL;
}