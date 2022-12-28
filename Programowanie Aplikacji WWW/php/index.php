<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        $nr_indexu = '162463';
        $nrGrupy = '2';
        echo 'Sebastian Tatkowski '.$nr_indexu.' grupa '.$nrGrupy.'<br/><br/>';
        echo 'Zastosowanie metody include() <br/>';
        include('hello.php');
        echo "<br/><br/>";
        echo 'Zastosowanie metody require_one()<br/>';
        require_once 'world.php';
        echo "<br/><br/>";
        echo "Zastosowanie metody if(), else() i elseif()<br/>";
        $x = 3;
        $y = 7;
        echo 'Zmienna x wynosi: '.$x.'<br/>';
        echo 'Zmienna y wynosi: '.$y.'<br/>';
        if($x > $y)
            echo 'Zmienna x jest większa o: '.$x-$y;
        elseif($y > $x)
            echo 'Zmienna y jest większa o: '.$y-$x;
        else
            echo 'Zmienne są równe';
        echo "<br/>Zastosowanie metody switch()<br/>";
        echo "Wybierz owoc!<br/>";
        $owoc = 'gruszka';
        switch($owoc){
            case "gruszka":
                echo "Wybrałeś owoc: gruszka!<br/>";
            break;
            case "jabłko":
                echo "Wybrałeś owoc: jabłko!<br/>";
            break;
            case "pomarańcza":
                echo "Wybrałeś owoc: pomarańcza!<br/>";
            break;
            case "kiwi":
                echo "Wybrałeś owoc: kiwi!<br/>";
            break;
            default:
                echo "Nie wybrałeś żadnego dostępnego owocu!";
        }
        echo "Zastosowanie pętli while()<br/>";
        $i = 1;
        while($i<6){
            echo $i.'. Hello World!<br/>';
            $i = $i + 1;
        }
        echo "Zastosowanie pętli for()<br/>";
        for($i=6; $i>-1; $i--)
        {
            echo 'Odliczanie: '.$i.'<br/>';
        }
        echo 'Zastosowanie zmiennej $_GET<br/>';
        echo '<a href="get.php?jedzenie1=owoców&jedzenie2=warzyw">$_GET</a><br/>';
        echo 'Zastosowanie zmiennej $_POST<br/>';
    ?>
    <p>Podaj owoc:</p>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="text" name="owoc">
		<input type="submit">
	</form>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $owoc = $_POST['owoc'];
        if(empty($owoc))
        {
            echo "Nie podałeś owocu!<br/>";
        }
        else
        {
            echo $owoc."<br/>";
        }
    }
    echo 'Zastosowanie zmiennej $_SESSION<br/>';
    $_SESSION['owoc'] = "truskawka";
	$_SESSION['warzywo'] = "rzodkiewka";
    echo "Wybrany owoc to: ".$_SESSION['owoc']."!<br/>";
    echo "Wybrane warzywo to: ".$_SESSION['warzywo']."!<br/>";
    ?>
</body>
</html>