<?php
abstract class House {

    abstract protected function getHouseName();
    abstract protected function getHouseMotto();
    abstract protected function getHouseSeat();

    public function introduce() {
        print("House " . $this->getHouseName()) . " of ";
        print($this->getHouseSeat());
        print(" : " . $this->getHouseMotto()) . PHP_EOL;
    }
}
?>