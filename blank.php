<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//includes don't know what yet


include 'includes/html_header.php';

$s = 'abcdef';
  for ($i = 0; $i < strlen($s); $i++) {
      if ($s[$i] > 'c') {
          echo $s[$i];
      }
  }
  
  $name = "Davey Shafik";
  // Simple match
  $regex = "/[a-zA-Z\s]/";
  if (preg_match($regex, $name)) {
      // Valid Name
  }
  // Match with subpatterns and capture
  $regex = '/^(\w+)\s(\w+)/';
  $matches = array();
  if (preg_match($regex, $name, $matches)) {
      var_dump($matches);
}
?>
<form action="index.php" method="GET">
      List: <input type="text" name="list" /><br />
      Order by:
      <select name="orderby">
          <option value="name">Name</option>
          <option value="city">City</option>
          <option value="zip">ZIP Code</option>
      </select><br />
      Sort order:
      <select name="direction">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
      </select>
</form>
  <!--Form submitted with POST-->
  <form action="index.php" method="POST">
      <input type="hidden" name="login" value="1" />
      <input type="text" name="user" />
      <input type="password" name="pass" />
</form>
  <form method="post">
      <p>
          Please choose all languages you currently know or
          would like to learn in the next 12 months.
      </p>
<p> <label>
              <input type="checkbox"
                     name="languages[]"
                     value="PHP" />
PHP </label>
          <label>
              <input type="checkbox"
                     name="languages[]"
                     value="Perl" />
              Perl
          </label>
          <label>
              <input type="checkbox"
                     name="languages[]"
                     value="Ruby" />
              Ruby
          </label>
          <br />
          <input type="submit" value="Send" name="poll" />
</p> </form>
