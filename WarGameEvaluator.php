<?php

require_once('WarGameCard.php');
require_once('WarGamePlayer.php');

class WarGameEvaluator
{
    public function determineWinner(array $cardsPlayedThisRound): array
    {
        $highestRank = -1; // 最高ランクを初期化
        $winnerIndices = []; // 勝者のインデックスを格納する配列を初期化

        foreach ($cardsPlayedThisRound as $played) {
            $card = $played['card']; // プレイされたカードを取得
            $currentRank = $card->getRank(); // カードのランクを取得

            // 現在のカードのランクがこれまでの最高ランクよりも高い場合
            if ($currentRank > $highestRank) {
                $highestRank = $currentRank; // 最高ランクを更新
                $winnerIndices = [$played['playerIndex']]; // 新しい勝者のインデックスで配列を初期化
            }
            // 現在のカードのランクがこれまでの最高ランクと同じ場合
            elseif ($currentRank == $highestRank) {
                $winnerIndices[] = $played['playerIndex']; // 既存の勝者のインデックス配列に追加
            }
        }

        return $winnerIndices; // 勝者のインデックスの配列を返す
    }
}

//出したカードの強さの大小を比べて、一番強いカードを出した人が勝ちとなり、
//場札（手札からめくられ場にオモテ向きに出されたカード）をもらいます。
