<?php

//foreach ($_GET as $key => $val)
//{
//    if ($key === "action")
//    {
//        if ($val === "set")
//        {
////            for ($n = 1; $n < sizeof($_GET); $n++)
////            if ($key[1] === "name" && $key[2] === "value")
////                setcookie($val[1], value);
//            foreach ($_GET as $key => $val)
//            {
//                if ($key === "name")
//                    setcookie($val);
//                if ($key === "value")
//                    setcookie($val);
//            }
//        }
//        elseif ($val === "get")
//        {
//            if(!isset($_COOKIE[$cookie_name])) {
//                echo "Cookie named '" . $cookie_name . "' is not set!";
////            foreach ($_GET as $key => $val)
////            {
////
////                if ($key === "name")
////                    setcookie($val);
////                if ($key === "value")
////                    setcookie($val);
////            }
//        }
//        elseif ($val === "del")
//
//    }
//    echo "$key: $val\n";
//}

    if ($_GET[action] === "set")
    {
        if ($_GET[name] && $_GET[value])
            setcookie($_GET[name], $_GET[value]);
        elseif ($_GET[name])
            setcookie($_GET[name]);
    }
    if ($_GET[action] === "get")
    {
        if ($_GET[name])
            echo ($_COOKIE($_GET[name]);
    }
    if ($_GET[action] === "del")
    {
        if ($_GET[name] && $_GET[value])
            setcookie($_GET[name], $_GET[value], );
        elseif ($_GET[name])
            setcookie($_GET[name]);
    }
?>