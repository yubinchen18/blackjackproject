<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Start session to be able to use $_SESSION superglobals.
session_start();

//Includes
include 'includes/config.php';
include 'includes/functions.php';

//deal button repress starts here.
start:
    
//deal first 4 cards automatically toggle.
if (CountRemainingCards($_SESSION['cardDeck'])>49 && $_POST['deal']=='deal')
{
    $_SESSION['autoDeal'] = "onload=\"autoDeal();\"";
}
else
{
    $_SESSION['autoDeal'] = "";
}
//rerun timer switch
if ($_POST['deal']=='deal')
    $rerunTimer = 300;
if ($_POST['deal']=='stand')
    $rerunTimer = 1500;

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Yubin's Blackjack project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body <?php echo $_SESSION['autoDeal']; ?> >
    <script>
        function autoDeal()
        {
            setTimeout(function(){document.forms["autoDeal"].submit();},<?php echo $rerunTimer?>)
        }
    </script>
    
<?php
/***********************************************************
//Alternatively deal first 4 cards between dealer and player, 
 initial to dealer first. Triggers on $_POST['deal']=='deal'.
 ***********************************************************/
if ($_POST['deal']=='deal')
{
    if (CountRemainingCards($_SESSION['cardDeck'])>48)    
    {
        $_SESSION["{$_SESSION['toWhom']}Cards"] = array_merge($_SESSION["{$_SESSION['toWhom']}Cards"],DrawCards($_SESSION['cardDeck'], 1));
        if ($_SESSION['toWhom'] == "player")
        {
            $_SESSION['toWhom'] = "dealer";
        }
        else
        {
            $_SESSION['toWhom'] = "player";
        }
    }
    else
    {
        $_SESSION['cardDeck'] = $originalCardDeck;
        $_SESSION['dealerCards'] = array();
        $_SESSION['playerCards'] = array();
        $_SESSION['hiddenCard'] = array();
        $_SESSION['dealerValue'] = null;
        $_SESSION['playerValue'] = null;
        $_SESSION['toWhom'] = "player";
        goto start;
    }
}
/***********************************************************
//When player chooses 'Hit', deals one card to player.
//When player chooses 'Stand', show dealers hands and deal card.
 ***********************************************************/
elseif ($_POST['deal']=='hit')
    {
        $_SESSION['toWhom'] = "player";
        $_SESSION["{$_SESSION['toWhom']}Cards"] = array_merge($_SESSION["{$_SESSION['toWhom']}Cards"],DrawCards($_SESSION['cardDeck'], 1));
    }
elseif ($_POST['deal']=='stand')
    {
        $_SESSION['toWhom'] = "dealer";
        if ($_SESSION['dealerCards'][0]['display'] == "backside.png")
        {
            $_SESSION["{$_SESSION['toWhom']}Cards"][0]['display'] = $_SESSION['hiddenCard']['display'];
        }    
        else
        {
            $_SESSION["{$_SESSION['toWhom']}Cards"] = array_merge($_SESSION["{$_SESSION['toWhom']}Cards"],DrawCards($_SESSION['cardDeck'], 1));
        }
/**********************************************************
               Sum up dealer cards value, check ACE
 **********************************************************/
        $_SESSION['dealerValue'] = SumOflValues($_SESSION['dealerCards']);
        if ($_SESSION['dealerValue']<21 && FindCard($_SESSION['dealerCards'],'value',1)==TRUE)
        {
            ChangeAceValue($_SESSION['dealerCards'],1,11);
            $_SESSION['dealerValue'] = SumOflValues($_SESSION['dealerCards']);
        }

        if ($_SESSION['dealerValue']>21 && FindCard($_SESSION['dealerCards'],'value',11)==TRUE)
        {
            ChangeAceValue($_SESSION['dealerCards'],11,1);
            $_SESSION['dealerValue'] = SumOflValues($_SESSION['dealerCards']);
        }
    }

//Save and hide first dealers card.
if (CountRemainingCards($_SESSION['cardDeck'])==50)
    {
        $_SESSION['hiddenCard'] = $_SESSION['dealerCards'][0];
        $_SESSION['dealerCards'][0]['display'] = "backside.png";
    }

/**********************************************************
               Sum up player cards value, check ACE
 **********************************************************/
$_SESSION['playerValue'] = SumOflValues($_SESSION['playerCards']);
if ($_SESSION['playerValue']<21 && FindCard($_SESSION['playerCards'],'value',1)==TRUE)
{
    ChangeAceValue($_SESSION['playerCards'],1,11);
    $_SESSION['playerValue'] = SumOflValues($_SESSION['playerCards']);
}

if ($_SESSION['playerValue']>21 && FindCard($_SESSION['playerCards'],'value',11)==TRUE)
{
    ChangeAceValue($_SESSION['playerCards'],11,1);
    $_SESSION['playerValue'] = SumOflValues($_SESSION['playerCards']);
}

 
/**********************************************************
            !!!!!!DISPLAY SECTION!!!!!!!!

 **********************************************************/
    
?>    
<div style="height:60px">
    <div style="height:60px; width:20%; float:left">
<?php
echo "Dealer's cards: <br>";
?>
    </div>
    <div style="height:60px; width:70%; float:left; background-color:white">
<?php

/**********************************************************
                        Dealer panel
 **********************************************************/
if ($_SESSION['dealerValue'] > 21)
{
    echo "<font size=\"18\">DEALER BUSTS!! HELL YEA!!</font>";
}
?>
    </div>
</div>
    
<div style="height:170px;">
    <?php 
    //Display dealers cards
    DisplayCards($_SESSION['dealerCards'], $settings['img_folder']);
    ?>
</div>

<div style="height:60px;">
    <div style="height:60px; width:20%; float:left">
<?php
    echo "Dealer's value: ".$_SESSION['dealerValue']."<br><br>";
    echo "Your cards: ";
?>
    </div>
    <div style="height:60px; width:70%; float:left">
<?php
/**********************************************************
                        Mid panel
 **********************************************************/
if ($_SESSION['dealerValue'] > 21)
{
    echo "<font size=\"18\">YOU PWN!</font>";
}
elseif ($_SESSION['playerValue'] > 21)
{
    echo "<font size=\"18\">LOSER!!!!!</font>";
}
elseif ($_SESSION['dealerValue']>=17 && $_SESSION['dealerValue']<=21 && $_SESSION['dealerValue']<$_SESSION['playerValue'])
{
    echo "<font size=\"18\">YOU WON! FAIR AND SQUARE!!</font>";
}
elseif ($_SESSION['dealerValue']>=17 && $_SESSION['dealerValue']<=21 && $_SESSION['dealerValue']>$_SESSION['playerValue'])
{
    echo "<font size=\"18\">NOOOOOOOOOO!!</font>";
}
elseif ($_SESSION['dealerValue']>=17 && $_SESSION['dealerValue']<=21 && $_SESSION['dealerValue']==$_SESSION['playerValue'])
{
    echo "<font size=\"18\">!---DRAW---!</font>";
}elseif (CountRemainingCards($_SESSION['cardDeck'])==48 && $_SESSION['playerValue']==21 && $_SESSION['dealerValue']!=21 && $_SESSION)
{
    echo "<font size=\"18\">SHOW ME THE MONEY!!!!!!</font>";
}
?>
    </div>    
</div>
<!--/**********************************************************
                        Player cards display
 **********************************************************/-->
<div>
<div style="height:220px; width:70%; float:left;">
    <div style="height:170px">
    <div style="height:170px;background-color:white;">
    <?php
 
    DisPlayCards($_SESSION['playerCards'], $settings['img_folder']);
    echo "<br><br>";
    
/**********************************************************
                        Wheel of fortune
 **********************************************************/
    ?>
    

    </div>
</div>
<div style="height:50px; background-color:yellow">
    <div style="height:50px; width:29%; float:left; background-color:white">
<?php
//Display extra information.
echo "Your value: ".$_SESSION['playerValue']."<br>";
echo "Cards remaining: ".CountRemainingCards($_SESSION['cardDeck']);
?>
    </div>
    <div style="height:50px; width:71%; float:left; background-color:white">
<?php

/**********************************************************
                        Player panel
 **********************************************************/
if ($_SESSION['playerValue'] > 21)
{
    echo "<font size=\"18\">BUSTED!! OMG!!!</font>";
}
?>
    </div>
</div>
</div>
<div style="height:300px; width:30%; float:left; background-color:white">
    <iframe src="wheel.php" frameborder=0 seamless scrolling=no height=350 width=200 name="slot" marginheight="0"></iframe>
    <?php
      
    ?>        
    </div>
    
    
</div>
<?php

//Automatically deal to dealer up to 17 after 'stand'.
if (SumOflValues($_SESSION['dealerCards'])<17 && $_POST['deal']=='stand')
{
    echo "<script>autoDeal();</script>";
}
?>
<form name= "autoDeal" action="round.php" method="post"> 
<input type="hidden" value=<?php echo $_POST['deal']?> name="deal" >
</form>

    
    
    
<?php
include 'includes/html_footer.php';
?>