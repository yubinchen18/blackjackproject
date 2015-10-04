<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Poster Circle</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=0.60, minimum-scale=0.60, maximum-scale=0.60">
    <style type="text/css">
        
        .holder
        {
            width: 400px;
            height: 200px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -200px -200px;
            background-color: red;
            -webkit-perspective: 800;
            -webkit-transform-style: preserve-3d;
            
            
            
        }
        
        .ring
        {
            -webkit-transform-style: preserve-3d;
            width:  200px;
            height: 200px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -100px -100px;
            background-color: black;
            -webkit-animation: x-spin 5s infinite linear;
            
        }
        
        .poster
        {
            padding: 0;
            width:  100px;
            height: 100px;
            background-color: pink;
            position: absolute;
            margin-left: auto ;
            margin-right: auto ;
            margin-top: auto ;
            margin-bottom: auto ;
            
            
        }
        
        .poster p
        {
            color: blue;
            margin: 0 auto;
            position: relative;
            top: 50%;
            text-align: center;
            -webkit-transform: translateY(-50%);
        }
        
        img.card
        {
            height: 145px;
            width: 100px;
            margin: 0px 0px;
            padding: 0;
            //float: left;
            display: block;
        }
        
        #photobanner
        {
            position: absolute;
            top: 200px;
            left: 200px;
            width: 100px;
            height: 145px;
            border: 5px solid black;
            background-color: white;
            overflow: hidden;
             //-webkit-animation: spin-move 5s linear infinite;
        }
        
        #strip
        {
            height: 1450px;
            width: 100px;
            position: absolute;
            top: -1305px;
            -webkit-animation: spin-move 3s linear infinite;
            -webkit-transition: all 2s ease-out;
        }
        
        #strip:hover
        {
            -webkit-transition:  2s ease-out;
            -webkit-animation-play-state: paused;
        }
        
        #first
        {
            //-webkit-animation: spin-move 5s linear infinite;
        }
        
        @-webkit-keyframes x-spin {
        0%    { -webkit-transform: rotateX(0deg); }
        50%   { -webkit-transform: rotateX(-180deg); }
        100%  { -webkit-transform: rotateX(-360deg); }
        }
        
        @-webkit-keyframes spin-move {
        0%    {margin-bottom: 0px;}
        100%  {margin-top: 1305px;}    
        }
    </style>
    <script>
        function stop()
        {
            document.getElementById("strip").style.margin-bottom = 133px;
                    
        }
    
    </script>
    </head>
<body>
    <?php
    $radius = 0;
    ?>
    
    <div class="holder">
        <div class="ring">
            <div class="poster" style="-webkit-transform: rotateX(1deg) translateZ(<?php echo $radius; ?>px);"><p>1</p></div>
            <div class="poster" style="-webkit-transform: rotateX(46deg) translateZ(<?php echo $radius; ?>px)"><p>2</p></div>
            <div class="poster" style="-webkit-transform: rotateX(91deg) translateZ(<?php echo $radius; ?>px)"><p>3</p></div>
            <div class="poster" style="-webkit-transform: rotateX(137deg) translateZ(<?php echo $radius; ?>px)"><p>4</p></div>
            <div class="poster" style="-webkit-transform: rotateX(181deg) translateZ(<?php echo $radius; ?>px)"><p>5</p></div>
            <div class="poster" style="-webkit-transform: rotateX(227deg) translateZ(<?php echo $radius; ?>px)"><p>6</p></div>
            <div class="poster" style="-webkit-transform: rotateX(271deg) translateZ(<?php echo $radius; ?>px)"><p>7</p></div>
            <div class="poster" style="-webkit-transform: rotateX(317deg) translateZ(<?php echo $radius; ?>px)"><p>8</p></div>
        </div>
    </div>
    
     
    <!-- Each image is 350px by 233px -->
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
    <button onclick="getposition();">click me</button>
    
    <script>
        function myclick()
        {
            var anim = document.getElementById("strip");
            anim.style.WebkitAnimation = "spin-move 8s ease-out infinite";
        }
        
        function getposition()
        {
            var computedStyle = getComputedStyle(document.getElementById("strip"), null)
            document.getElementById("demo").innerHTML = computedStyle.marginTop;
        }
    </script>
    <p id="demo"></p>
</body>
</html>