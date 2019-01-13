<?php
/**
 * Email Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Email extends Model
{
    function crypt($email,$title=null)
    {
        $email = str_replace(array('@','.'), array('&#064;','&#046;'), $email);
        $string = '<a href="mailto:'.$email.'">'.(($title)?$title:$email).'</a>';
        $len = strlen($string);
        $i=0;
        $par = array();
        while($i<$len)
        {
            $c = mt_rand(1,4);
            $par[] = addslashes(substr($string, $i, $c));
            $i += $c;
        }
        $join = implode('"+ "', $par);
        return '<script:no-cache type="text/javascript"><!--'.PHP_EOL.'window.document.write("'.$join.'");'.PHP_EOL.'--></script>';
    }
}