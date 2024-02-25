<?php

require_once('WarCard.php');
require_once('WarGamePlayer');

class WarHandEvaluator
{
  public function __construct(private array $warCards)
  {
  }

//出したカードの強さの大小を比べて、一番強いカードを出した人が勝ちとなり、
//場札（手札からめくられ場にオモテ向きに出されたカード）をもらいます。
}
