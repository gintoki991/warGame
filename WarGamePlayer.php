<?php

require_once('WarGameDeck.php');
require_once('WarGameCard.php');
require_once('WarGame.php');

class WarGamePlayer
{
    public function __construct(private string $name)
    {
      $this->name = $name;
    }

    //カードをプレーヤーに均等に配布(親が担当)
    public function dealCards(WarGameDeck $deck, int $playersCount, int $dealerIndex): array
    {
       // 各プレーヤーの手札を初期化
      $cardsInHand = array_fill(0, $playersCount, []);
       // デッキからカードの配列を一度取得
      $deckCards = $deck->getCards();
      //カードを配布
      while (count($deckCards) > 0) {
        for ($i = 0; $i < $playersCount; $i++) {
          if (!empty($deckCards)){
            $playerIndex = ($dealerIndex + $i) % $playersCount;
            $cardsInHand[$playerIndex][] = array_shift($deckCards);
          }
        }
      }
      return $cardsInHand;
    }

    //カードをフィールドに表示する
    public function displayCard()
    {
      // 表示ロジックを実装
      //手札束の一番上のカードを、場にオモテ向きに置きます。
      //手札からカードを一枚引く（表示するにはゲームクラス）

      //条件分岐，一番強い数値が複数出た場合、もう一度手札からカードを出します。
      //同じ数字が続いたら、勝ち負けが決まるまでカードを出します。

      //そして、勝ったプレイヤーが場札をもらいます。（もらう場札のカードはフィールドクラスで実装）
    }


}
