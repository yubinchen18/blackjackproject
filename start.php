<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Start session to be able to use $_SESSION superglobals.
session_start();

include 'includes/config.php';
include 'includes/functions.php';
include 'includes/html_header.php';

//ini session values;
$_SESSION['cardDeck'] = $originalCardDeck;
$_SESSION['dealerCards'] = array();
$_SESSION['playerCards'] = array();
$_SESSION['hiddenCard'] = array();
$_SESSION['dealerValue'] = null;
$_SESSION['playerValue'] = null;
$_SESSION['toWhom'] = "player";
$_SESSION['playerName'] = $_GET['input_title'].". ".$_GET['input_name'];

if ($_GET['input_title']=="Mr.")
    $welcomePhrase = "Good luck hero!";  
 else
    $welcomePhrase = "You go girl!";

echo "<br>";
echo "Welcome ".$_SESSION['playerName']."! ".$welcomePhrase;

echo "<br>";

//dealerscards iframe.
echo "<iframe src=\"round.php\" frameborder=0 seamless scrolling=no height=550 width=100% name=\"screen\"></iframe>";
echo "<br><br>";
?>
<form action="round.php" target="screen" method="post"> 
    <button style="width:100px;height:50px;vertical-align:top;" type="submit" value="deal" name="deal" >LETS ROLL!!!</button>
    <button style="width:150px;height:50px;vertical-align:top;" type="submit" value="hit" name="deal">HIT ME!</button>
    <button style="width:150px;height:50px;vertical-align:top;" type="submit" value="stand" name="deal">NO MORE!!</button>
    
</form>


<?php
?>