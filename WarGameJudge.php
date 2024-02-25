<?php

require_once('WarGamePlayer.php');

class WarGameJudge
{
    // 手札の枚数が多い順に順位を1位、2位、・・・と表示する
    public function determineRankings(array $players)
    {
        // プレイヤーを手札の枚数が多い順にソート
        usort($players, function($a, $b) {
            return count($b->getHand()) <=> count($a->getHand());
        });

        // 各プレイヤーの手札の枚数を表示
        foreach ($players as $player) {
            echo $player->getName() . "の手札の枚数は" . count($player->getHand()) . "枚です。\n";
        }

        // 順位とプレイヤー名を表示
        foreach ($players as $index => $player) {
            echo ($index + 1) . "位が " . $player->getName() . "です。 ";
          }
          echo "\n 戦争を終了します。\n";
    }
}
