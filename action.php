<?php
    include_once "fx.php";
    
    if(isset($_POST) && count($_POST) > 0) {
        $g = uniqid();
        $img_m = ["image/png", "image/jpg", "image/jpeg", "image/webp", "image/gif"];
        if(isset($_POST["new_topic"])) {
            // new topic
            if(isset($_POST["p"]) && $_POST["p"] != "") {
                $b = $_POST["b"]; $p = hash("sha256", $_POST["p"]);
                $chk_b = sql("select count(*) as c from b where b = '$b'");
                if($chk_b != -1 && intval($chk_b["c"]) > 0) {
                    if((isset($_POST["s"]) && $_POST["s"] != "") && (isset($_POST["m"]) && $_POST["m"] != "")) {
                        $s = $_POST["s"]; $m = $_POST["m"]; $mi = $_FILES["i"]["type"];
                        if(isset($_FILES["i"]) && in_array($mi, $img_m)) {
                            // upload image first, then create the topic
                            $img = base64_encode(file_get_contents($_FILES["i"]["tmp_name"]));
                            $img_up = sql("insert into i (g, m, i) values ('$g', '$mi', '$img')");
                            if($img_up == 0) {
                                $topic_up = sql("insert into t (b, g, t, m, i, p) values ('$b', '$g', '$s', '$m', '$g', '$p')");
                                if($topic_up == 0) {
                                    header("location: /?b=$b&t=$g");
                                } else { echo "Cannot create topic"; }
                            } else { echo "Cannot upload image"; }
                        } else { echo "Topic needs to have image"; }
                    } else { echo "Fill out all fields"; }
                } else { echo "Board does not exist"; }
            } else { echo "Password is required for this"; }
        } else if(isset($_POST["new_message"])) {
            // new message
            if((isset($_POST["p"]) && $_POST["p"] != "") && (isset($_POST["t"]) && $_POST["t"] != "")) {
                $b = $_POST["b"]; $t = $_POST["t"]; $p = hash("sha256", $_POST["p"]);
                $chk_b = sql("select count(*) as c from t where b = '$b' and g = '$t'");
                if($chk_b != -1 && intval($chk_b["c"]) > 0) {
                    // upload image if exists, because messages don't neccesary to have images lol
                    if(isset($_FILES["i"]) && in_array($mi, $img_m)) {
                        $img = base64_encode(file_get_contents($_FILES["i"]["tmp_name"]));
                        $img_up = sql("insert into i (g, m, i) values ('$g', '$mi', '$img')");
                        if($img_up == 0) {
                            if((isset($_POST["s"]) && $_POST["s"] != "") && (isset($_POST["m"]) && $_POST["m"] != "")) {
                                $s = $_POST["s"]; $m = $_POST["m"]; $mi = $_FILES["i"]["type"];
                                $msg_up = sql("insert into m (b, g, t, s, m, i, p) values ('$b', '$g', '$t', '$s', '$m', '$g', '$p')");
                                if($msg_up == 0) {
                                    header("location: /?b=$b&t=$t&m=$g");
                                } else { echo "Cannot write message"; }
                            } else { echo "Fill out all fields"; }
                        } else { echo "Cannot upload image"; }
                    } else {
                        if((isset($_POST["s"]) && $_POST["s"] != "") && (isset($_POST["m"]) && $_POST["m"] != "")) {
                            $s = $_POST["s"]; $m = $_POST["m"]; $mi = $_FILES["i"]["type"];
                            $msg_up = sql("insert into m (b, g, t, s, m, p) values ('$b', '$g', '$t', '$s', '$m', '$p')");
                            if($msg_up == 0) {
                                header("location: /?b=$b&t=$t&m=$g");
                            } else { echo "Cannot write message"; }
                        } else { echo "Fill out all fields"; }
                    }
                } else { echo "Topic and board does not exist"; }
            } else { echo "Password is required for this"; }
        } else if(isset($_POST["edit_topic"])) {
            // edit topic
            if(isset($_POST["p"]) && $_POST["p"] != "") {
                $p = hash("sha256", $_POST["p"]);
                print_r($_POST);
            } else { echo "Password is required for this"; }
        } else if(isset($_POST["edit_message"])) {
            // edit message
            if(isset($_POST["p"]) && $_POST["p"] != "") {
                $p = hash("sha256", $_POST["p"]);
                print_r($_POST);
            } else { echo "Password is required for this"; }
        } else if(isset($_POST["delete_topic"])) {
            // delete topic
            if(isset($_POST["p"]) && $_POST["p"] != "") {
                $p = hash("sha256", $_POST["p"]);
                print_r($_POST);
            } else { echo "Password is required for this"; }
        } else if(isset($_POST["delete_message"])) {
            // delete message
            if((isset($_POST["p"]) && $_POST["p"] != "") && (isset($_POST["t"]) && $_POST["t"] != "")) {
                $t = $_POST["t"];
                $p = hash("sha256", $_POST["p"]);
                $chk_p = sql("select p from m where t = '$t'");
                if($chk_p != -1) {
                    if($p === $chk_p["p"]) {
                        echo "Valid password";
                    } else { echo "Incorrect password"; }
                } else { echo "Message does not exist"; }
                print_r($_POST);
            } else { echo "Password is required for this"; }
        } else { print_r($_POST); }
    } else if(isset($_GET) && count($_GET) > 0) {
        // new
        if(isset($_GET["new"]) && $_GET["new"] != "") {
            $new = $_GET["new"];
            $new_acts = ["topic", "message"];
            if(in_array($new, $new_acts)) {
                if($new == "topic") {
?>
<form action="/action.php?new=topic" method="post" enctype="multipart/form-data">
    <input type="text" name="b" placeholder="Board" <?php if(isset($_GET["b"]) && $_GET["b"] != "") { ?>value="<?php echo $_GET["b"]; ?>"<?php } ?>><br>
    <input type="text" name="s" placeholder="Subject"><br>
    <textarea name="m" placeholder="Message" cols="30" rows="10"></textarea><br>
    <input type="file" name="i"><br>
    <input type="password" name="p" placeholder="Password">
    <input type="submit" name="new_topic">
</form>
<?php
                } else if($new == "message") {
?>
<form action="/action.php?new=message" method="post" enctype="multipart/form-data">
    <input type="text" name="b" placeholder="Board" <?php if(isset($_GET["b"]) && $_GET["b"] != "") { ?>value="<?php echo $_GET["b"]; ?>"<?php } ?>><br>
    <input type="text" name="t" placeholder="Topic" <?php if(isset($_GET["t"]) && $_GET["t"] != "") { ?>value="<?php echo $_GET["t"]; ?>"<?php } ?>><br>
    <input type="text" name="s" placeholder="Subject"><br>
    <textarea name="m" placeholder="Message" cols="30" rows="10"></textarea><br>
    <input type="file" name="i"><br>
    <input type="password" name="p" placeholder="Password">
    <input type="submit" name="new_message">
</form>
<?php
                } else { echo "new... what?"; }
            } else { echo "new... what?"; }
        }
        // edit
        else if(isset($_GET["edit"]) && $_GET["edit"] != "") {
            $edit = $_GET["edit"];
            $edit_acts = ["topic", "message"];
            if(in_array($edit, $edit_acts)) {
                if($edit == "topic") {
                    echo "edit topic";
                } else if($edit == "message") {
                    echo "edit message";
                } else { echo "edit... what?"; }
            } else { echo "edit... what?"; }
        }
        // delete
        else if(isset($_GET["delete"]) && $_GET["delete"] != "") {
            $delete = $_GET["delete"];
            $delete_acts = ["topic", "message"];
            if(in_array($delete, $delete_acts)) {
                if($delete == "topic") {
                    if((isset($_GET["b"]) && $_GET["b"] != "") && (isset($_GET["t"]) && $_GET["t"] != "")) {
                        $b = $_GET["b"]; $t = $_GET["t"]; $m = $_GET["m"];
?>
<form action="/action.php?delete=message&b=<?php echo $b; ?>&t=<?php echo $t; ?>" method="post">
    <input type="hidden" name="b" value="<?php echo $b; ?>"><input type="hidden" name="t" value="<?php echo $t; ?>">
    <input type="password" name="p" placeholder="Enter password to confirm">
    <input type="submit" value="delete_topic">
</form>
<?php
                    } else { echo "Specify ID of topic & message"; }
                } else if($delete == "message") {
                    if((isset($_GET["b"]) && $_GET["b"] != "") && (isset($_GET["t"]) && $_GET["t"] != "") && (isset($_GET["m"]) && $_GET["m"] != "")) {
                        $b = $_GET["b"]; $t = $_GET["t"]; $m = $_GET["m"];
?>
<form action="/action.php?delete=message&b=<?php echo $b; ?>&t=<?php echo $t; ?>&m=<?php echo $m; ?>" method="post">
    <input type="hidden" name="b" value="<?php echo $b; ?>"><input type="hidden" name="t" value="<?php echo $t; ?>"><input type="hidden" name="m" value="<?php echo $m; ?>">
    <input type="password" name="p" placeholder="Enter password to confirm">
    <input type="submit" value="delete_message">
</form>
<?php
                    } else { echo "Specify ID of topic & message"; }
                } else { echo "delete... what?"; }
            } else { echo "delete... what?"; }
        } else { header("location: /action.php"); }
    } else {
        echo "<a href=\"/\">to lobby...</a>";
        echo "
            <h1>Actions</h1>
            <ul>
                <li><a href=\"/action.php?new=topic\">New Topic</a></li>
                <li><a href=\"/action.php?new=message\">New Message</a></li>
            </ul>
            <ul>
                <li><a href=\"/action.php?edit=topic\">Edit Topic</a></li>
                <li><a href=\"/action.php?edit=message\">Edit Message</a></li>
            </ul>
            <ul>
                <li><a href=\"/action.php?delete=topic\">Delete Topic</a></li>
                <li><a href=\"/action.php?delete=message\">Delete Message</a></li>
            </ul>
        ";
    }
?>