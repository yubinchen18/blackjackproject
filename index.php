<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//includes don't know what yet

include 'includes/config.php';
include 'includes/functions.php';
include 'includes/html_header.php';

//Here begins the code
?>



<div>
    Welcome to Yubin's Blackjack table!<br>
    Please enter your information below<br>
    <br><br>
</div>

<form action="start.php" method="get" name="signin_form">
    <input type="radio" name="input_title" value="Mr.">Mr.</input>
    <input type="radio" name="input_title" value="Mrs">Mrs</input><br>
    Name: <input type="text" name="input_name" value="Player"><br>
    <input type="submit" value="Sign In!" </input>
</form>
    

      
<?php
include 'includes/html_footer.php';       
?>
