<?php

require_once('WarGame.php');

$game = new WarGame();
$game->registerPlayers('player1', 'player2');
$game->start();
$game->playRound();
