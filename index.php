<?php
    /* loqsh! */

    include_once "fx.php";
    
    if(isset($_GET) && count($_GET) > 0) {
        // board
        if(isset($_GET["b"]) && $_GET["b"] != "") {
            $b = $_GET["b"];
            // topic
            if(isset($_GET["t"]) && $_GET["t"] != "") {
                $t = $_GET["t"];
                if(isset($_GET["m"]) && $_GET["m"] != "") {
                    $m = $_GET["m"];
                    $data = sql("select * from m where b = '$b' and t = '$t' and g = '$m'");
                    if($data != -1) {
                        print_r($data);
                    } else { echo "message not found"; }
                }
                // topic page
                else if(isset($_GET["p"]) && (intval($_GET["p"]) > 0)) {
                    $p = $_GET["p"];
                    echo "board $b topic $t page $p";
                } else { // default topic
                    $data = sql("select * from t where b = '$b' and g = '$t'");
                    if($data != -1) {
                        print_r($data);
                        $msgs = sql("select * from m where b = '$b' and t = '$t'");
                        echo "<hr>";
                        if($msgs != -1) {
                            print_r($msgs);
                        } else { echo "nobody written here"; }
                    } else { echo "topic not found"; }
                }
            }
            // board page
            else if(isset($_GET["p"]) && (intval($_GET["p"]) > 0)) {
                $p = $_GET["p"];
                echo "board $b page $p";
            } else { // default board
                $data = sql("select * from b where b = '$b'");
                if($data != -1) {
                    print_r($data);
                } else { echo "board not found"; }
            }
        }
        // image
        else if(isset($_GET["i"]) && $_GET["i"] != "") {
            $i = $_GET["i"];
            $data = sql("select * from i where g = '$i'");
            if($data != -1) {
                $mime = $data["m"]; $i = base64_decode($data["i"]);
                header("Content-Type: $mime");
                echo $i;
            } else { echo "image not found"; }
        }
        // else
        else { echo "not found"; }
    }
    else {
        echo "<h1>Loqsh!</h1>";
        $data = sql("select b from b");
        if($data != -1) {
            echo "<ul>";
            if(count($data) > 2) {
                for($i = 0; $i < count($data); $i++) {
                    $b = $data[$i]["b"];
                    echo "<li><a href=\"/?b=$b\">$b</a></li>";
                }
            } else {
                $b = $data["b"];
                echo "<li><a href=\"/?b=$b\">$b</a></li>";
            }
            echo "</ul>";
        }
    }
?>