<?php

require_once('WarGamePlayer.php');
require_once('WarGameDeck.php');
require_once('WarGameJudge.php');

class WarGame
{
    private array $WarGamePlayers = [];
    private WarGameDeck $deck;
    private array $cardsPlayedThisRound = [];
    private WarGameEvaluator $evaluator;

    public function __construct()
    {
        $this->deck = new WarGameDeck(); // デッキを初期化
        $this->evaluator = new WarGameEvaluator();
    }

    public function start()
{
    echo "戦争を開始します。\n";
    $this->dealCards();
    echo "カードが配られました。\n";
    echo "戦争！\n";

    while (true) { // 無限ループ
        if ($this->playRound()) { // playRoundからゲーム終了の信号があればループを抜ける
            break;
        }
    }
    // ゲーム終了時にプレイヤーの順位を表示
    $judge = new WarGameJudge();
    $judge->determineRankings($this->WarGamePlayers);
}


    public function playRound()
    {
        $this->cardsPlayedThisRound = [];
        foreach ($this->WarGamePlayers as $index => $player) {
            $card = $player->playCard();
            if ($card !== null) {
                $this->cardsPlayedThisRound[] = ['card' => $card, 'playerIndex' => $index];
                echo $player->getName() . " のカードは " . $card->getSuit() . "の" .  $card->getNumber() . " です。\n";
            }

            // プレイヤーの手札が空になったかチェック
            if (empty($player->getHand())) {
                echo "プレイヤー" . ($index + 1) . "（" . $player->getName() . "）の手札がなくなりました。\n";
                return true; // ゲーム終了の信号を返す
        }

        // 全プレイヤーがカードを出し終わった後に勝者を決定
        $winnerIndices = $this->evaluator->determineWinner($this->cardsPlayedThisRound);

        // 再プレイが必要な場合（勝者が複数いる場合）
        if (count($winnerIndices) > 1) {
            echo "引き分けです。\n";
            echo "戦争！\n";
            $this->playRound(); // playRoundメソッドを再度呼び出す
        } elseif (count($winnerIndices) == 1) {
            // 勝者が1人の場合、勝者のインデックスを取得
            $winnerIndex = $winnerIndices[0];
            $winner = $this->WarGamePlayers[$winnerIndex];
            $numCardsWon = count($this->cardsPlayedThisRound); // 受け取るカードの枚数

            // 勝者がフィールドのカードを受け取る
              foreach ($this->cardsPlayedThisRound as $played) {
                $this->WarGamePlayers[$winnerIndex]->addFieldCard($played['card']);
                // 勝者と受け取ったカードの枚数を表示
              }
              echo $winner->getName() . "が勝ちました。" . $winner->getName() . "はカードを" . $numCardsWon . "枚もらいました。\n";
        } else {
            // 勝者がいない場合
        }

        // 手札が空になったプレイヤーは場札を手札に移動
        foreach ($this->WarGamePlayers as $player) {
            $player->refillHandFromField();
        }
      }
      return false; // ゲームが終了していない信号を返す
    }


        // ゲーム開始時に各プレイヤーにカードを配る
        public function dealCards()
        {
            $this->deck->shuffle(); // デッキをシャッフル

            while (!$this->deck->isEmpty()) {
                foreach ($this->WarGamePlayers as $player) {
                    if (!$this->deck->isEmpty()) {
                        $card = $this->deck->drawCard(); // デッキからカードを1枚引く
                        $player->addCardToHand($card); // プレイヤーの手札にカードを追加
                    }
                }
            }
        }

       //プレーヤーを登録する
        public function registerPlayers(string ...$names): void
        {
            foreach ($names as $name) {
                $this->WarGamePlayers[] = new WarGamePlayer($name);
                }
        }

        //プレーヤの人数を取得
        public function getPlayersCount()
        {
            return count($this->WarGamePlayers);
        }



}
