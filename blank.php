<!DOCTYPE html>
<html>
    <head>
        <title>Yubin's Blackjack project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body>
<?php

session_start();


$count = 1;
if(isset($_POST['hit']) && $_SESSION['blackjack_state'] == "in_game")
{
	hit("player");
	//check if player busted
	if(countCards($_SESSION['blackjack_player_cards']) > 21)
	{
		echo "You busted, dealer won...";
		$_SESSION['blackjack_state'] = 2;
	}
}
//player decided to stay
elseif((isset($_POST['stay'])) && ($_SESSION['blackjack_state'] == "in_game"))
{
	//calc player & dealer points
	$dealer = countCards($_SESSION['blackjack_dealer_cards']);
	$player = countCards($_SESSION['blackjack_player_cards']);

	//if dealer under 17 points, keep hitting.
	while($dealer < 19)
	{
		hit("dealer");
		$dealer = countCards($_SESSION['blackjack_dealer_cards']);
	}
	
	//dealer has blackjack
	if($dealer == 21)
	{
		
		echo "Dealer Got BlackJack... You lost...";
	}
	elseif($dealer >= $player) //dealer has more points then player
	{
		//if dealer under 21, they win
		if($dealer < 21)
		{
			echo "Dealer Won...";
		}
		else //dealer busted (OVER 21)
		{
			echo "Congradulations, you won. The dealer busted...";
		}
	}
	else//player won
	{
		//player has blackjack
		if($player == 21)
		{
                    if (($player % 3) && ($player == 21))  {
                        echo "You got black jack...";
                    }
			
		}
		else //player one by point values
		{
			echo "Congradulations, You won...";
		}
	}
	
	$_SESSION['blackjack_state'] = "game_over";
}
elseif(isset($_POST['new_game'])) //create new game
{
	makeGame();
}
elseif($_SESSION['blackjack_state'] != "in_game" ) //usually "first" visit. Create game.
{
	makeGame();
}

//hit 
function hit($who)
{
	$temp = explode('-', $_SESSION['blackjack_deck'][$_SESSION['blackjack_card_count']]);
	$_SESSION['blackjack_' . $who . "_cards"][count($_SESSION['blackjack_' . $who . "_cards"])] = $temp[0];
	$_SESSION['blackjack_' . $who . "_suits"][count($_SESSION['blackjack_' . $who . "_suits"])] = $temp[1];
	$_SESSION['blackjack_card_count']++;
}

//count value of cards
function countCards($cards)
{
	//reassign some cards by number.
	for($x=0; $x<count($cards); $x++)
	{
		switch ($cards[$x])
		{
			case "j":
				$cards[$x] = 10;
				break;
			case "q":
				$cards[$x] = 10;
				break;
			case "k":
				$cards[$x] = 10;
				break;
		}
	}
	
	//start counting the cards
	for($x=0; $x<count($cards);$x++)
	{
		//if the card isn't an ACE
		if(is_numeric($cards[$x]))
		{
			$count = $count + $cards[$x];
		}
		else //if card is an ace, we'll count last. 
		{
			$delay[] = $card[$x];
		}
	}
	//check if there's any ACES
	if(count($delay) > 0)
	{
		//if ONE ACE
		if(count($delay) == 1)
		{
			//if total count of cards is 10 or less then 10, we'll make ACE 11,
			if($count <= 10)
			{
				$count = $count +  11;
			}//if the total count of cards is 21, player busted.
			elseif($count >= 21)
			{
				$count= $count + 1;
			}
		}
		else//if more then one ace
		{
			//loop through all aces
			for($x=0; $x<count($delay); $x++)
			{
				//if total count is less then 10 minus the count of the other aces, ACE is 11
				if($count <= 10 - count($delay))
				{
					$count = $count + 11;
				}
				elseif($count >= 21)
				{
					$count = $count + 1;
				}
			}
		}
	}
	
	//return card count
	return $count;
}

function makeGame()
{
	session_destroy();
	session_start();
	//set game stat
	$_SESSION['blackjack_state'] = "in_game";

	//create deck
	$_SESSION['blackjack_deck'] = array(
	"2-c", "3-c", "4-c", "5-c", "6-c", "7-c", "8-c", "9-c", "10-c", "j-c", "q-c", "k-c", "a-c", 
	"2-d", "3-d", "4-d", "5-d", "6-d", "7-d", "8-d", "9-d", "10-d", "j-d", "q-d", "k-d", "a-d", 
	"2-h", "3-h", "4-h", "5-h", "6-h", "7-h", "8-h", "9-h", "10-h", "j-h", "q-h", "k-h", "a-h", 
	"2-s", "3-s", "4-s", "5-s", "6-s", "7-s", "8-s", "9-s", "10-s", "j-s", "q-s", "k-s", "a-s");

	//shuffle deck
	shuffle($_SESSION['blackjack_deck']);	

	//temp counter
	$count = 0;

	//deal player cards
	for($x=0;$x<2;$x++)
	{
		$_SESSION['blackjack_player'][] = $_SESSION['blackjack_deck'][$count];
		$_SESSION['blackjack_dealer'][] = $_SESSION['blackjack_deck'][($count + 1)];
		$count = $count + 2;;
	}

	//display players cards
	for($x=0; $x<2;$x++)
	{
		$temp = explode('-', $_SESSION['blackjack_player'][$x]);
		$_SESSION['blackjack_player_cards'][] = $temp[0];
		$_SESSION['blackjack_player_suits'][] = $temp[1];
	}

	//deal dealers card
	for($x=0; $x<2;$x++)
	{
		$temp = explode('-', $_SESSION['blackjack_dealer'][$x]);
		$_SESSION['blackjack_dealer_cards'][] = $temp[0];
		$_SESSION['blackjack_dealer_suits'][] = $temp[1];
	}
	
	//check if dealer was dealt blackjack
	if(countCards($_SESSION['blackjack_dealer_cards']) == 21)
	{
		echo "Dealer Won. He was dealt blackjack...";
	}
	else
	{
		$_SESSION['blackjack_card_count'] = 4;
	}
}
?>
<div id="outcome" style="color:red"></div>
<form name="form" method="post" action="">
<table>
	<tr>
		<td>Dealer's Cards</td>
		<?php
		if($_SESSION['blackjack_state'] == "game_over")
		{
		for($x=0; $x<5; $x++)
		{
		?><td>
		<img src="cards/e/<?php echo $_SESSION['blackjack_dealer_cards'][$x] . $_SESSION['blackjack_dealer_suits'][$x] . ".jpg"; ?>" name="dealercard_<?= $x+1 ?>" id="dealercard_<?= $x+1 ?>"><br>
		</td><?php
		}
		}
		else
		{
		for($x=0; $x<5; $x++)
		{
		?><td>
                    
		<img src="cards/e/.jpg" name="dealercard_<?= $x+1 ?>" id="dealercard_<?= $x+1 ?>"><br>
		</td><?php
		}
		}
		?>
	</tr>
	<tr>
		<td>Player's Cards</td>
		<?php
		for($x=0; $x<5; $x++)
		{
		?><td><img src="cards/e/<?php echo $_SESSION['blackjack_player_cards'][$x] . $_SESSION['blackjack_player_suits'][$x] . ".jpg"; ?>" name="playercard_<?= $x+1 ?>" id="playercard_<?= $x+1 ?>">
		<?php
		}
		?>
	</tr>
</form>
<?php
//staying
if(!isset($_POST['stay']))
{
?>
	<tr>
		<td colspan="2">
		<!-- JQuery  -->
		<div id="test">
			<input type="submit" name="hit" id="hit" value="Hit Me" />
		</div>
		<!-- End of jquery -->
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<!-- JQuery  -->
		<div id="test3">
			<input type="submit" name="stay" id="stay" value="Stay" />
		</div>
		<!-- End of jquery -->
		</td>
	</tr>
<?php
}
?>
	<tr>
		<td colspan="2">
		<!-- JQuery  -->
		<div id="test1">
			<input type="submit" name="new_game" id="new_game" value="New Game" />
		</div>
		<!-- End of jquery -->
		</td>
	</tr>
</table>