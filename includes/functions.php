<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$originalCardDeck = array (
                            "diamonds" => array 
                            (
                                1 => '1','2','3','4','5','6','7','8','9','10','11','12','13'   
                            ),
                            "clubs" => array
                            (
                                1 => '1','2','3','4','5','6','7','8','9','10','11','12','13'
                            ),
                            "hearts" => array
                            (
                                1 => '1','2','3','4','5','6','7','8','9','10','11','12','13'
                            ),
                            "spades" => array
                            (
                                1 => '1','2','3','4','5','6','7','8','9','10','11','12','13'
                            )
                            );
        

       
//Randomly draws one card out of card deck, determines its face value, then removes the card from the deck. returns array[][display]/[value]
//Initial ACE value = 11
function DrawCards(&$deck, $amount = 1)
{
    for ($i=1; $i<=$amount;$i++)
    {
        $suit = array_rand($deck);
        $faceCard = array_rand($deck[$suit]);
        unset($deck[$suit][$faceCard]);          
        if ($faceCard > 10)
            $faceValue = 10;
        else
            $faceValue = (int)$faceCard;
        
        if ($faceCard == 1)
                $cardName = "ace";
        elseif ($faceCard>1 && $faceCard<11)
                $cardName = $faceCard;
        elseif ($faceCard == 11)
                $cardName = "jack";
        elseif ($faceCard == 12)
                $cardName = "queen";
        elseif ($faceCard == 13)
                $cardName = "king"; 
        
        $returnValue[] = array ('display' => "$cardName"."_of_"."$suit.png", 'value' => $faceValue);         
    }
    return $returnValue;
}


// Count remaining cards in deck.
function CountRemainingCards($deck)
{
    $cards = 0;
    foreach ($deck as $value)
        $cards = $cards + count($value);
    return $cards;
}

// Sum up values of cards in an array.
function SumOflValues($cards)
{
    $sum = 0;
    foreach ($cards as $card)
    {
        $sum = $sum + $card['value'];
    }
    return $sum;
}

//Display cards on middle of the screen.
function DisplayCards($cards, $folder)
{ 
        foreach ($cards as $card)
        {
            echo "<img src='".$folder.$card['display']."' align= \"left\" heights= \"145.2\" width= \"100\" hspace=\"5\">";
        }
}

//Reset.

//Find key value pair in array
function FindCard($array, $key, $val) 
{
    foreach ($array as $item)
        if (isset($item[$key]) && $item[$key] == $val)
            return true;
    return false;
}

function ChangeAceValue(&$array,$oldval,$newval)
{
    $key = 'value';
    foreach ($array as &$item)
    {
        if (isset($item[$key]) && $item[$key] == $oldval)
        {
            $item[$key] = $newval;
        }
    }
}

$spinWheel = array("hearts" => array(1 => '1','2','3','4','5','6','7','8','9','10','11','12','13'));
