<?php
include 'includes/config.php';
include 'includes/functions.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Yubin's Blackjack project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body onload="autoDeal();" >
    <script>
        function autoDeal()
        {
            setTimeout(function(){document.forms["autoDeal"].submit();},100)
        }
    </script>
<?php

$deck = $originalCardDeck;

function DisplayOneCard($deck, $amount=1)
{
    for ($i=1; $i<=$amount;$i++)
    {
        $suit = array_rand($deck);
        $faceCard = array_rand($deck[$suit]);          
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


$card = DisplayOneCard($deck,1);
/*

echo "<img src='".$settings['img_folder'].$card[0]['display']."' align= \"left\" heights= \"145.2\" width= \"100\">";
?>


    
<form name= "autoDeal" action="wheel.php" method="post"> 
<input type="hidden" value="spin" name="wheel" >
</form>
 * 
 */
?>
<div>
<div id="photobanner">
    <div id="strip">
       <img class="card" id="first" src="resources/playingcards/ace_of_hearts.png"
            ><img class="card" src="resources/playingcards/9_of_hearts.png"
            ><img class="card" src="resources/playingcards/8_of_hearts.png"
            ><img class="card" src="resources/playingcards/7_of_hearts.png"
            ><img class="card" src="resources/playingcards/6_of_hearts.png"
            ><img class="card" src="resources/playingcards/5_of_hearts.png"
            ><img class="card" src="resources/playingcards/4_of_hearts.png"
            ><img class="card" src="resources/playingcards/3_of_hearts.png"
            ><img class="card" src="resources/playingcards/2_of_hearts.png"
            ><img class="card" src="resources/playingcards/ace_of_hearts.png">
    </div>
</div>
<div id="buttoncontainer" style="position:absolute; top:180px;">
    <div id="button" style="margin-left:-2px">
        <button style="width:100px;height:50px;vertical-align:top;" type="submit" value="stop" name="wheel">STOP!</button>
    </div>
</div>

<?php
include 'includes/html_footer.php';       
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>