<?php
class   Lannister {

    public function sleepWith($persone){
        $newPers = new ReflectionClass($persone);
        if($newPers->getName() == "Sansa")
            print("Let's do this") . PHP_EOL;
        if($newPers->getName() == "Cersei")
            print("Not even if I'm drunk !") . PHP_EOL;
        if($newPers->getName() == "Jaime")
            print("Not even if I'm drunk !") . PHP_EOL;
        if($newPers->getName() == "Tyrion")
            print("Not even if I'm drunk !") . PHP_EOL;
    }
}
?>