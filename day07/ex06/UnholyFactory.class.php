<?php
class UnholyFactory {
    private $_array = array();
    public function absorb($obj) {
        $str = mb_strtolower(get_class($obj));
        if ($str === 'footsoldier')
            $str = substr($str, 0, 4)." ".substr($str, 4, 7);
        if (array_key_exists($str, $this->_array))
            echo "(Factory already absorbed a fighter of type " . $str . ")" . PHP_EOL;
        else
        {
            $this->_array[$str] = $obj;
            if (is_subclass_of($obj, 'Fighter'))
                echo "(Factory absorbed a fighter of type " . $str . ")" . PHP_EOL;
            else
                echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
        }
    }
    public function fabricate($fabr) {
        if ($fabr === 'foot soldier' || $fabr === 'archer' || $fabr === 'assassin')
        {
            echo "(Factory fabricates a fighter of type " . $fabr . ")" . PHP_EOL;
            return ($this->_array[$fabr]);
        }
        else
        {
            echo "(Factory hasn't absorbed any fighter of type " . $fabr . ")" . PHP_EOL;
            return (NULL);
        }
    }
}
?>