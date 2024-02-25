<?php

require_once('WarGameDeck.php');
require_once('WarGameCard.php');
require_once('WarGame.php');
require_once('WarGameField.php');

class WarGamePlayer
{
    private array $hand = [];
    private array $WarGamePlayers = [];
    private array $fieldCards = []; // 勝ちカードを一時的に保存する場札


    public function __construct(private string $name)
    {
      $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

        // 手札にカードを追加するメソッド
    public function addCardToHand($card)
    {
        $this->hand[] = $card;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    // 手札からカードを1枚プレイするメソッド
    public function playCard()
    {
        if (!empty($this->hand)) {
            return array_shift($this->hand); //手札束の一番上のカードを一枚引いて，フィールドに置く
        }
        return null; // 手札が空の場合はnullを返す
    }

   // 手札が空になった時に場札を手札に移動するメソッド
    public function refillHandFromField()
    {
        if (empty($this->hand) && !empty($this->fieldCards)) {
            $this->hand = $this->fieldCards;
            $this->fieldCards = [];
        }
    }

     // 場札にカードを追加するメソッド
    public function addFieldCard($card)
    {
        $this->fieldCards[] = $card;
    }

}
