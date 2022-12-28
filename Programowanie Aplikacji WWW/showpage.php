<?php
    function PokazPodstrone($id) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $link = mysqli_connect($dbhost, $dbuser, $dbpass);
        $query = "SELECT * FROM `moja_strona`.`page_list` where id = $id LIMIT 1;";
        $result = $link -> query($query);
        $row = mysqli_fetch_array($result);
        if(empty($row))
        {
            $web = '<div style="font-size:100px; text-align: center;">Nie znaleziono strony!</div>';
        }
        else
        {
            $web = $row['page_content'];
        }
        return $web;
    }
?>