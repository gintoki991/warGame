<?php

require_once('WarGameCard.php');

class WarGameDeck
{
    private array $deck = [];

    public function __construct()
    {
        foreach (['C', 'H', 'S', 'D'] as $suit) {
            foreach (range(1, 13) as $number) {
                $this->deck[] = new WarGameCard($suit, $number);
            }
        }
    }

    public function shuffle()
    {
        shuffle($this->deck);
    }

    public function getCards(): array
    {
      return $this->deck;
    }
}
