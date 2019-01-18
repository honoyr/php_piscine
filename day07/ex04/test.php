<?php

include_once('Lannister.class.php');
include_once('Jaime.class.php');
include_once('Tyrion.class.php');

class Stark {
}

class Cersei extends Lannister {
}

class Sansa extends Stark {
}

$j = new Jaime(); /// L
$c = new Cersei(); //L g
$t = new Tyrion(); // L
$s = new Sansa(); // S g

//$c->sleepWith($s);
//$c->sleepWith($t);
//$c->sleepWith($c);
//$c->sleepWith($j);
//

$j->sleepWith($t);
$j->sleepWith($s);
$j->sleepWith($c);
//
$t->sleepWith($j);
$t->sleepWith($s);
$t->sleepWith($c);

?>
