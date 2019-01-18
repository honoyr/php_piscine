<?php

include_once('Lannister.class.php');

class   Jaime extends Lannister {
    public function sleepWith($persone)
    {
        $newPers = new ReflectionClass($persone);
        if ($newPers->getName() === "Cersei")
            print("With pleasure, but only in a tower in Winterfell, then.") . PHP_EOL;
        elseif ($newPers->getName() === "Sansa")
            print("Let's do this") . PHP_EOL;
        else
            print("Not even if I'm drunk !") . PHP_EOL;
    }
}
?>