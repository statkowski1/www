<?php
    function FormularzLogowania()
    {
        $wynik ='
        <div  class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                    <table class="logowanie" style="margin-left: auto; margin-right: auto;">
                        <tr><td class="log4_t">EMAIL: </td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
                        <tr><td class="log4_t">HASŁO: </td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
                        <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Zaloguj"/></td></tr>
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
        $return = '<div><form method="POST" name="crud" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table style="margin-left:auto; margin-right:auto;"><tr><td><input type="submit" value="Dodaj" name="add"></td></tr><tr><td>ID</td><td>Tytuł strony</td><td>Status strony</td><td>Opcje</td></tr>';
        while($row = mysqli_fetch_array($result))
        {
            $return = $return.'<tr><td>'.$row['id'].'</td><td>'.$row['page_title'].'</td><td>'.$row['status'].'</td><td><button style="margin-right:5px;" type="submit" value='.$row['id'].' name="edit">Edytuj</button><button type="submit" value='.$row['id'].' name="delete">Usuń</button></td></tr>';
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
        <div class="edit-div">
            <h2>Edytuj strone</h2>
            <form method="POST">
                <label>Id :</label><input type="text" name="id_page" value='.$id.' readonly>
                <label>Tytuł strony: </label><input type="text" name="edit_page_title" value='.$page_title.'>
                <label>Zawartość strony: </label><input type="text" name="edit_page_content" value='.$page_content.'>
                <label>Status strony: </label><input type="checkbox" name="page_status[]" value="a"';
        if($status==1)
        {
            $return = $return.' checked';
        }
        $return = $return.'
                >
                <input type="submit" name="powrot" value="Wróć">
                <input type="submit" name="edit_page" value="Zapisz">
            </form>
        </div>
        ';
        if(isset($_POST['edit_page']))
        {
            $id = $_POST['id_page'];
            $new_page_title = $_POST['edit_page_title'];
            $new_page_content = $_POST['edit_page_content'];
            $check_status = $_POST['page_status'];
            if($check_status[0]=='a')
            {
                $new_status = 1;
            }
            else
            {
                $new_status = 0;
            }
            $query = "UPDATE page_list SET page_title='$new_page_title', page_content='$new_page_content', status='$new_status' WHERE id='$id'";
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
                    <td><label>Status strony: </label><input type="checkbox" name="page_status" value="1"></td>
                    <td><input type="submit" name="add_page" value="Dodaj"></td>
                    <td><input type="submit" name="powrot" value="Wróć"></td>
                </form>
            </tr></table>
        ';

        if(isset($_POST['add_page']))
        {
            $page_title = $_POST['add_page_title'];
            $page_content = $_POST['add_page_content'];
            $check_status = $_POST['page_status'];
            if($check_status[0]==1)
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            $query = "INSERT INTO page_list values (NULL, '$page_title', '$page_content', '$status') LIMIT 1";
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
        }
    }

    function CRUD()
    {
        include('cfg.php');
        $logout = '
        <form method="POST">
            <input type ="submit" name="wyloguj" value="Wyloguj">
        </form>
        ';
        if(($_SESSION['login']==true || $_POST['login_email']==$login && $_POST['login_pass']==$password))
        {
            $_SESSION['login'] = true;
            if(array_key_exists('add', $_POST))
            {
                $return = DodajNowaPodstrone();
            }
            elseif(array_key_exists('add_page', $_POST))
            {
                DodajNowaPodstrone();
                $return = ListaPodstron();
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
            elseif(array_key_exists('edit_page', $_POST))
            {
                EdytujPodstrone();
                $return = ListaPodstron();
            }
            elseif(array_key_exists('wyloguj', $_POST))
            {
                $_SESSION['login'] = false;
            }
            else
            {
                $return = ListaPodstron();
            }
            return $return.$logout;
        }
        elseif(array_key_exists('x1_submit', $_POST) && ($_POST['login_email']!=$login || $_POST['login_pass']!=$password))
        {
            return '<h1>Złe dane logowania!</h1>'.FormularzLogowania();
        }
        return FormularzLogowania();
    }
?>
