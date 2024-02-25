<?php

require_once('WarGamePlayer.php');

class WarGame
{
    private array $WarGamePlayers = [];

    public function __construct(private string $name)
    {
    }

    public function start()
    {
        echo "戦争を開始します。". PHP_EOL;

        // プレーヤーの中から親を選ぶ
        $playersCount = $this->getPlayersCount();
        if ($playersCount > 0) {
            $dealerIndex = rand(0, $playersCount - 1);
            $dealer = $this->WarGamePlayers[$dealerIndex];
            // 親がカードを配る
            $dealer->dealCards();

            echo "カードが配られました。". PHP_EOL;
            echo "戦争！". PHP_EOL;

            //fieldのカードをコンソールに表示
            

            //勝ち負けが決まったら、勝ったプレイヤーの名前を表示(勝ち負けはjudgeクラスが担当)
        }
    }

       //プレーヤーを登録する
        public function registerPlayer($name)
        {
            $this->WarGamePlayers[] = new WarGamePlayer($name);
        }

        //プレーヤの人数を取得
        public function getPlayersCount()
        {
            return count($this->WarGamePlayers);
        }



}
