<?php
    /* loqsh! */

    include_once "fx.php";
    
    if(isset($_POST) && count($_POST) > 0) {
        print_r($_POST);
    } else if(isset($_GET) && count($_GET) > 0) {
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
                        $bimg = $data["i"];
                        echo "<img src=\"/?i=$bimg\" style=\"width: 200px\"><br>";
                        print_r($data);
                        echo "<p>
                                <a href=\"/action.php?new=message&b=$b&t=$t\">+ New Message</a>
                              </p>";
                        $msgs = sql("select * from m where b = '$b' and t = '$t'");
                        echo "<hr>";
                        if($msgs != -1) {
                            if(count($msgs) > 0) {
                                echo "<ul>";
                                for($i = 0; $i < count($msgs); $i++) {
                                    $id = $msgs[$i]["g"]; $t = $msgs[$i]["t"]; $s = $msgs[$i]["s"]; $m = $msgs[$i]["m"];
                                    echo "<li><a href=\"/?b=$b&t=$t&m=$id\">";
                                    if($msgs[$i]["i"] != "") {
                                        $im = $msgs[$i]["i"];
                                        echo "<p><img src=\"/?i=$im\" style=\"width: 120px\"></p>";
                                    }
                                    echo "
                                        <p style=\"margin: 0; padding: 0\">$s</p>
                                        <p style=\"margin: 0; padding-left: 20px\">$m</p></a>
                                    </li>";
                                }
                                echo "<ul>";
                            } else { print_r($msgs); }
                        } else { echo "nobody written here"; }
                    } else { echo "topic not found"; }
                }
            }
            // board page
            else if(isset($_GET["p"]) && (intval($_GET["p"]) > 0)) {
                $p = $_GET["p"];
                echo "board $b page $p";
            } else { // default board
                $data = sql("select b, t, a, css, j from b where b = '$b'");
                if($data != -1) {
                    $t = $data["t"]; $a = $data["a"]; $css = $data["css"]; $j = $data["j"];
                    if($css != "") { echo "<style>$css</style>"; }
                    echo "
                        <title>$t / Loqsh!</title>
                        <a href=\"/\">back to lobby</a>
                        <h1>$t</h1>
                        <p>$a</p>
                        <p>Created $j</p>
                        <a href=\"/action.php?new=topic&b=$b\">+ New Topic</a>
                    ";
                    $topics = sql("select * from t where b = '$b'");
                    echo "<hr>";
                    if($topics != -1) {
                        if(count($topics) > 0) {
                            echo "<ul>";
                            for($i = 0; $i < count($topics); $i++) {
                                $id = $topics[$i]["g"]; $t = $topics[$i]["t"]; $m = $topics[$i]["m"];
                                echo "<li><a href=\"/?b=$b&t=$id\">";
                                if($topics[$i]["i"] != "") {
                                    $im = $topics[$i]["i"];
                                    echo "<p><img src=\"/?i=$im\" style=\"width: 120px\"></p>";
                                }
                                echo "
                                    <p style=\"margin: 0; padding: 0\">$t</p>
                                    <p style=\"margin: 0; padding-left: 20px\">$m</p></a>
                                </li>";
                            }
                            echo "<ul>";
                        } else {
                            print_r($topics);
                        }
                    } else { echo "no topics here"; }
                } else { echo "board not found"; }
            }
        }
        // image
        else if(isset($_GET["i"]) && $_GET["i"] != "") {
            $i = $_GET["i"];
            $data = sql("select * from i where g = '$i'");
            if($data != -1) {
                $mime = $data["m"]; $i = base64_decode($data["i"]);
                header("Content-Type: $mime"); header("Accept-Ranges: bytes"); header("Content-Length: ".strlen($i));
                echo $i;
            } else { echo "image not found"; }
        }
        // else
        else { echo "not found"; }
    }
    else {
        echo "<h1>Loqsh!</h1><a href=\"/action.php\">Actions</a>";
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