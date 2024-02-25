<?php

require_once('WarGameEvaluator.php');
require_once('WarGamePlayer.php');

class WarGameField
{
  private array $fieldCards = [];

    // フィールドにカードを追加（引数$cardはプレーヤークラスで実装）
    public function addCardToField(WarGamePlayer $card, $playerIndex)
    {
        //$this->cardsOnField[$playerIndex][] = $card;
        $this->fieldCards = array_merge($this->fieldCards, $card);
    }

    public function shuffleFieldCards()
    {
        shuffle($this->fieldCards);
    }

    public function getFieldCards(): array
    {
        $cards = $this->fieldCards;
        $this->fieldCards = []; // 場札を空にする
        return $cards;
    }

    public function isEmpty(): bool
    {
        return empty($this->fieldCards);
    }
  // 各プレイヤーは裏向きの手札束の一番上のカードを、
  // 場にオモテ向きに置きます。これを表示する

  //カードを一時保管。
  //勝敗が決まったら，勝者にカードを渡す。
}
