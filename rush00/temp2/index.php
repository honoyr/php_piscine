<?php require 'cart.php'; ?>
<!--<!DOCTYPE html>-->
<html>
<head>
    <title>Day of the 42</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="doft.css">
</head>
<body>
  <div class="gray header-block">
    <div alt="logo day of the 42" class="day"></div>
        <div class="header-right">
            <a href="php/create.html" title="Create account" alt="Create account" class="disconnect"/><p>Create account</p>
            </a>
            <a href="php/login.html" title="Authorization" alt="Authorization" class="reload"/><p>Sign in</p></a>
        </div>
    </div>
    <div class="menu">
      <div class="dropdown">
          <button class="dropbtn">Shop</button>
          <div class="dropdown-content">
              <a href="#">Box</a>
              <a href="#">Basketball</a>
              <a href="#">Footbal</a>
          </div>
      </div>
        <div class="dropdown">
            <a href="#">
                <button class="dropbtn">About</button>
            </a>
        </div>
        <div class="dropdown">
            <a href="#">
                <button class="dropbtn">Contacts</button>
            </a>
        </div>
    </div>
    <!--<img src="resources/loupe.png" alt="loupe" class="loupe"/>-->
  <!--</div>-->
  <!--<hr>-->

  <div class="mid">

    <!-- LEFT BOX -->
<!--    <div class="gray left_box">-->
<!--      <img src="resources/arrow.png" title="Advance" class="arrow alt="Advance"/>-->
<!--      <img src="resources/main.png" title="Take" class="hand" alt="Take" class="hand"/>-->
<!--      <img src="resources/oeil.png" title="Look" class="eye" alt="Look" class="eye"/>-->
<!--      <img src="resources/outil.png" title="Use" class="tools" alt="Use" class="tools"/>-->
<!--      <img src="resources/chat-icon.png" title="Speak" class="chat" alt="Speak"/>-->
<!--    </div>-->
    <!-- MIDDLE BOX-->
    <div class="gray Claster_box">
        <div>
            <?php products()?>
            <br />
            <?php cart()?>
            <br />
        </div>
    </div>
    <!-- RIGHT BOX -->
    <div class="gray right_box">
        <a href="">
            <img src="img/web/boxes.png" title="Basket" alt="Basket" class="book"/>
        </a>
        <img src="resources/towel.png" title="Towel" alt="towel" class="towel"/>
        <div class="bricks">
            <div alt="brick" class="brick" title="Brick"></div>
            <div alt="brick" class="brick" title="Brick"></div>
        </div>
    </div>
    <!-- FORM BOX -->
    <!--<div class="form_green">-->
      <!--<p>Vous-->
          <!--<span style="font-size: 2vw;">entrez</span> -->
          <!--alors dans une grande piece remplie d'-->
          <!--<span class="red">ordinateurs</span>...</p>-->
      <!--<p style="font-style: italic;" >- Bonjour, vous êtes nouveau ici ?</p>-->
      <!--<form>-->
        <!--<input type="text" class="form">-->
        <!--<input type="submit" value="Repondre" class="repond">-->
      <!--</form>-->
    <!--</div>-->
  </div>
</body>
</html>