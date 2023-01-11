<?php
    /* connector to db */
    function conn() {
        $servername = "localhost"; $username = "root"; $password = ""; $dbname = "loqsh";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error) { die($conn->connect_error); }
        return $conn;
    }
    /* sql query */
    function sql($q, $p = 1) {
        $conn = conn();
        $query = $conn->query($q);
        if(strtolower(substr($q, 0, strlen("select"))) === "select") {
            if($query->num_rows > 0) {
                if($query->num_rows == 1) {
                    $row = $query->fetch_assoc();
                    return $row;
                } else {
                    $data = array();
                    while($row = $query->fetch_assoc()) {
                        array_push($data, $row);
                    }
                    return $data;
                }
            } else { return -1; }
        } else { if($query === TRUE) { return 0; } else { return $conn->error; } }
        $conn->close();
    }
?>