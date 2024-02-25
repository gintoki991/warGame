<?php

require_once('WarGameCard.php');

class WarGameDeck
{
    private array $deck = [];

    public function __construct()
    {
        foreach (['C', 'H', 'S', 'D'] as $suit) {
            foreach (range(2, 10) as $number) {
                $this->deck[] = new WarGameCard($suit, (string)$number);
            }
            foreach (['J', 'Q', 'K', 'A'] as $face) {
                $this->deck[] = new WarGameCard($suit, $face);
            }
        }

    }

    //デッキをシャッフル
    public function shuffle()
    {
        shuffle($this->deck);
    }

    //他クラスからデッキ内のカードにアクセスできるようにする
    public function getCards(): array
    {
      return $this->deck;
    }

     // デッキからカードを1枚引く
    public function drawCard()
    {
        return array_shift($this->deck);
    }

    // デッキが空かどうかをチェック
    public function isEmpty(): bool
    {
        return empty($this->deck);
    }
}
