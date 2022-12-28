<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <title>Największe budynki świata</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="zdjecia/downtown-building-old-style-architectuer-skyscraper-icon_176411-2870.png" type="image/icon type">
        <meta charset="UTF-8">
        <script src="js/kolorujtlo.js" type="text/javascript"></script>
        <script src="js/timedate.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/powiekszenie_elementu.js" type="text/javascript"></script>
        <script src="js/powiekszenie_elementu_po_najechaniu_kursorem.js" type="text/javascript"></script>
        <script src="js/powiekszenie_elementu_po_kazdym_kliknieciu.js" type="text/javascript"></script>
    </head>

    <body onload="startclock()">
        <div class="menu">
                <ul>
                    <li><a href="index.php?idp=">Home</a></li>
                    <li><a href="index.php?idp=najwyzsze_budynki">Najwyższe budynki</a></li>
                    <li><a href="index.php?idp=firmy_budowlane">Firmy budowlane</a></li>
                    <li><a href="index.php?idp=szkice_i_modele">Szkice i Modele budynków</a></li>
                    <li><a href="index.php?idp=filmy">Filmy</a></li>
                    <li style="float: right"><a class="active" href="index.php?idp=kontakt">Kontakt</a></li>
                </ul>
            </div>
        
        <div class="kolorowanie_tla">
            <FORM>
                <INPUT TYPE="button" VALUE="normal mode" ONCLICK="changeBackground('#3399CC')" />
                <INPUT TYPE="button" VALUE="orange mode" ONCLICK="changeBackground('#FF8000')" />
                <INPUT TYPE="button" VALUE="green mode" ONCLICK="changeBackground('#00FF00')" />
            </FORM>
        </div>

    <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        include('cfg.php');
        include('showpage.php');
        if($_GET['idp'] == '') $strona = 1;
        if($_GET['idp'] == 'najwyzsze_budynki') $strona = 2;
        if($_GET['idp'] == 'firmy_budowlane') $strona = 3;
        if($_GET['idp'] == 'szkice_i_modele') $strona = 4;
        if($_GET['idp'] == 'filmy') $strona = 5;
        if($_GET['idp'] == 'kontakt') $strona = 6;
        echo PokazPodstrone($strona);
    ?>

    <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        include('admin/admin.php');
        echo CRUD();
        //echo DodajNowaPodstrone();
    ?>

    <table>
        <tr>
            <td>a</td>
            <td>b</td>
            <td>c</td>
        </tr>
        <tr>
        <td>q</td>
        <td>w</td>
        <td>e</td>
        </tr>
    </table>

    <?php
        $nr_indexu = '162463';
        $nrGrupy = '2';
        echo '<br/><br/>Autor strony: Sebastian Tatkowski, numer indexu: '.$nr_indexu.', numer grupy: '.$nrGrupy.'<br/><br/>';
    ?>
    </body>


</html>