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
        $return = '<div><form method="POST" name="crud" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table style="margin-left:auto; margin-right:auto;"><tr><td><input type="submit" value="Dodaj" name="add"></td></tr><tr><td>ID</td><td>Tytuł strony</td><td>Status strony</td></tr>';
        while($row = mysqli_fetch_array($result))
        {
            $return = $return.'<tr><td>'.$row['id'].'</td><td>'.$row['page_title'].'</td><td>'.$row['status'].'</td><td><button style="margin-right:5px;" type="submit" value='.$row['id'].' name="edit">Edytuj</button><button type="submit" value='.$row['id'].' name="delete">Usuń</button></input></td></tr>';
        }
        $return = $return.'</table></form></div>';
        return $return;
    }

    function EdytujPodstrone()
    {
        include('cfg.php');
        //$query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content' WHERE id='$id' LIMIT 1";
        $id = $_POST['edit'];
        $result = mysqli_query($link, "SELECT page_title, page_content, status FROM page_list WHERE id='$id'");
        $row = mysqli_fetch_array($result);
        $page_title = $row['page_title'];
        $page_content = $row['page_content'];
        $status = $row['status'];
        $return = '
        <table>
            <form method="POST">
                <tr><td>Id: </td><td>'.$id.'</td></tr>
                <tr><td><label>Tytuł strony: </label></td><td><input type="text" value="'.$page_title.'" name="edit_page_title"></td></tr>
                <tr><td><label>Zawartość strony: </label></td><td><input type="text" value="'.$page_content.'" name="edit_page_content"></td></tr>
                <tr><td><label>Status strony: </label></td><td><input type="checkbox" name="page_status[]" value="1"';
        if($status==1)
        {
            $return = $return.' checked';
        }
        $return = $return.'
                ></td></tr>
                <tr><td><input type="submit" name="edit_page" value="Zapisz"></td>
                <td><input type="submit" name="powrot" value="Wróć"></td></tr>
            </form>
        </table>
        ';
        if(isset($_POST['edit_page']))
        {
            $page_title = $_POST['edit_page_title'];
            $page_content = $_POST['edit_page_content'];
            $check_status = $_POST['page_status'];
            $query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content', status='$status' WHERE id='$id' LIMIT 1";
            if($check_status[0]=='1')
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            mysqli_query($link, $query);
        }
        if(isset($_POST['powrot']))
        {
            return ListaPodstron();
        }
        return $return;
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
                    <td><input type="submit" name="add" value="Dodaj"></td>
                    <td><input type="submit" name="powrot" value="Wróć"></td>
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
        elseif(array_key_exists('delete', $_POST))
        {
            echo UsunPodstrone();
            echo ListaPodstron();
        }
        elseif(array_key_exists('edit', $_POST))
        {
            $return = EdytujPodstrone();
        }
        else
        {
            $return = ListaPodstron();
        }
        return $return;
    }

    function test()
    {
        $return = '
        <form method="POST">
            <input type="checkbox" name="V[]" value="1">
            <input type="submit" name="s1" value="Zatwierdz">
        </form>
        ';
        echo $return;
        $v = $_POST['V'];
        if(isset($_POST['s1']))
        {
            if($v[0]=='1')
            {
                echo "PEŁNY";
            }
            else
            {
                echo "PUSTY";
            }
        }
    }
?>
