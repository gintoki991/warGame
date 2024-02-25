<?php

class WarGameCard
{
    const CARD_RANK = [
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13,
    ];

    public function __construct(private string $suit, private string $number)
    {
        $this->suit = $suit;
        $this->number = $number;
    }

    // スーツを取得するメソッド
    public function getSuit(): string
    {
        return $this->suit;
    }

    // 数値を取得するメソッド
    public function getNumber(): string
    {
        return $this->number;
    }

    // ランクを取得するメソッド
    public function getRank(): int
    {
        return self::CARD_RANK[$this->number];
    }
}
