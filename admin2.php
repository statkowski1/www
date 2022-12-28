<?php
    function FormularzLogowania()
    {
        $wynik ='
        <div class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                    <table class="logowanie">
                        <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
                        <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
                        <tr><td>&nbsp;</td><td><input type="submit" name="x1_submimt" class="logowanie" value="Zaloguj"/></td></tr>
                    </table>
                </form>
            </div>
        </div>
        ';
        return $wynik;
    }

    function ListaPodstron()
    {
        include('cfg.php');
        $query = "SELECT * FROM page_list ORDER BY id ASC LIMIT 100";
        $result = mysqli_query($link, $query);
        $return = '<div><form method="POST" name="crud" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table style="margin-left:auto; margin-right:auto;"><tr><td><input type="submit" value="dodaj" name="add"></td></tr>';
        while($row = mysqli_fetch_array($result))
        {
            $return = $return.'<tr><td>'.$row['id'].'</td><td>'.$row['page_title'].'</td><td><button type="submit" value='.$row['id'].' name="edit">edytuj</button></td><td><button type="submit" value='.$row['id'].' name="delete">usuń</button></input></td></tr>';
        }
        $return = $return.'</table></form></div>';
        return $return;
    }

    function EdytujPodstrone()
    {
        include('cfg.php');
        $form = '
        <form method="POST" action="'.$_REQUEST['URI'].'">
            <label>id</label><input type="text" name="edit_id">
            <label>Tytuł strony: </label><input type="text" name="edit_page_title">
            <label>Zawartość strony: </label><input type="text" name="edit_page_content">
            <input type="submit" name="edytuj">
        </form>
        </br>
        ';
        while($row = mysqli_fetch_array($result))
        {

        }
        echo $form;
        if(isset($_POST['edytuj']))
        {
            $id = $_POST['edit_id'];
            $page_title = $_POST['edit_page_title'];
            $page_content = $_POST['edit_page_content'];
            $query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content' WHERE id='$id'";
            mysqli_query($link, $query);
            header("Locaction: admin.php");
        }
    }

    function DodajNowaPodstrone()
    {
        include('cfg.php');
        $return = '
        <h1>Dodaj nową stronę:</h1>
            <table style="margin-left:auto; margin-right:auto;"><tr>
                <form method="POST">
                    <td><label>Tytuł strony: </label><input type="text" name="add_page_title"></td>
                    <td><label>Zawartość strony: </label><input style="height:100px; width:300px;" type="text" name="add_page_content"></td>
                    <td><input type="submit" name="add"></td>
                    <td><input type="submit" name="powrot" value="wróć"></td>
                </form>
            </tr></table>
        ';

        if(isset($_POST['add']))
        {
            $page_title = $_POST['add_page_title'];
            $page_content = $_POST['add_page_content'];
            $query = "INSERT INTO page_list values (NULL, '$page_title', '$page_content', '1') LIMIT 1";
            mysqli_query($link, $query);
        }
        if(isset($_POST['powrot']))
        {
            return ListaPodstron();
        }
        return $return;
    }

    function UsunPodstrone()
    {
        include('cfg.php');
        $form = '
        <label>id</label><input type="text" name="del_id">
        <input type="submit" value="usun" name="delete">
        ';
        echo $form;
        if(isset($_POST['delete']))
        {
            $id = $_POST['delete'];
            $page_title = $_POST['del_page_title'];
            $page_content = $_POST['del_page_content'];
            $query = "DELETE FROM page_list WHERE id='$id' LIMIT 1";
            mysqli_query($link, $query);
            header("Locaction: admin.php");
        }
    }

    function CRUD()
    {
        /*
        echo '<form method="POST"><input type="submit" name="submit"></form>';
        if(array_key_exists('submit', $_POST))
        {
            echo "AAAAAAAAAAA";
        }
        echo 'd'.isset($_POST['submit']);
        */
        if(array_key_exists('add', $_POST))
        {
            $return = DodajNowaPodstrone();
        }
        else
        {
            $return = ListaPodstron();
        }
        return $return;
    }

?>
