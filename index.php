<?php
    //Adatbáziskacsolódás forrásának beemelése
    require_once 'config/config.php';
    /**
     * Külső állományok forrásának beemelése:
     *      include
     *      include_once
     *      require
     *      require_once
     */
    
    /**
     * A PHP szkriptet minden esetben PHP TAG-ek (<?php ... ?>) közzé kell zárni:
     * 
     *  <?php [PHP szintakszisnak megfelelő kód] ?>
     * 
     * Minden utasítást pontosvesszővel (;) zárunk le.
     * 
     * VÁLTOZÓK PHP BAN
     *  minden változó a dollár ($) jellel kezdődik
     *  kis- és nagybetüket figyelembe veszi
     *  számmal nem kezdődhet, ékezetes karaktereket nem tartalmazhat
     *  a nem alfanumerikus karakterek közzül csak az alulvonás (_) elfogadott
     *    pl. $a = 'alma';
     * 
     * TÖMBÖK KEZELÉSE
     *  Két típusa van:
     *      sorszámozott tömbök
     *          indexek természetes egész számok, sorszám 0-tól indul, felülírható a sorszámozás
     *      asszociatív tömbök
     *          indexek sztringek, indexelés nem automatikus, 
     *          konvenció alapján az index neveire a változók neveinek szabálya él
     * 
     *  Tömb létrehozás több módon lehetséges; sorszámmal indexelt
     * 
     *      $a = array(); - array() függvény tömbtípust állít be
     *      $a = array('tartalom','tartalom2',3,object, array(),true,false); - kezdő tartalommal feltöltött tömb
     * 
     *    Szögletes zárójellel:
     *      $a[] = 'tartalom';
     *      $a[] = 'tartalom2'; - indexelés automatikus
     * 
     *  Asszociatív tömb létrehozása
     *      Az index szöveges (sztring), az array() fv.-nyel létrehozott tömb indexéhez,
     *      a hozzárendelő művelettel /=>/ lehet tartalmat adni
     *      
     *  Szögletes zárójellel:
     *      $a              = array('elso'=>'tartalom','masodik'=>'tartalom2');
     *      $a['elso']      = 'tartalom';
     *      $a['masodik']   = 'tartalom2';
     *   
     *  A PHP gyengén típusos, azaz a változókat nem kell előre deklarálni sem definiálni, 
     *  a típust a PHP értelmező állítja be automatikusan az értéknek megfelelően
     * 
     * PHP a vezérlési szerkezetek esetében két típusú blokkosítást ismer:
     *  kapcsoszárójelek közzé írt { ... }
     *  kettőspont (:) és end+vezérlési szerkezet közzé írt utasítások
     *    pl. if(...): ... [else: ...] endif;
     *        for(...): ... endfor;
     *        while(...) ... endwhile;
     *        foreach(...): ... endforeach;
     * 
     * 
     * KIÍRATÁS A KÉPERNYŐRE
     *  Szöveg és változók tartalmának kiíratására több utasítás/lehetőség is adódik:
     *      print 'szöveg'; print $a;
     *      echo 'szöveg'; echo $a;
     *      <?='szöveg'?> <?=$a?> - PHP rövid kiíratási módszer, 
     *          fejlesztők előszeretettel használják a PHP HTML-be történő ágyazásakor. 
     *          (A lenti FOR szerkezetben erre láthatunk mintát)
     *  
     * Az, hogy a PHP a HTML-be ágyazható azt jelenti, 
     * hogy vezérlési szerkezetek kódblokkjaiba a PHP TAG-et megtörve 
     * tisztán HTML kódot írhatok, amely az adott vezérlési szerkezet magjához fog tartozni, 
     * erre több példát is láthatunk a forrásunkban
     */

    /**
     * HTML ÜRLAPOK KEZELÉSE PHP SZKRIPTTEL
     * 
     * A kliensoldalról adatokat küldeni HTTP protokollal a HTTP metódusok segítségével lehet.
     *      Alapértelmezetten a HTTP a GET lekérő metódust használja, amit az URL-ben lehet paraméterezni
     *          pl: https://www.google.hu/search?q=PHP
     *          A példában a https://www.google.hu/search a webcím, 
     *          kérdőjel után (?) a q betű a paraméter elnevezése, értéke PHP. 
     *          További paramétereket hozzáfűzni az első után az & (amp) jellel lehetséges.
     *          A GET paramétereket renszerint adatbázisból történő lekérdezésekkor használjuk.
     * 
     *      POST HTTP metódus. 
     *          Az HTML űrlapról történő adatküldéshez, 
     *          amelyeket rendszerint adatbázisba mentünk POST metódussal küldjük
     *              <form method="POST"> .... </form>
     * 
     * SZUPERGLOBÁLIS TÖMBÖK A PHP-BAN
     *      Alapértelmezetten deklarált asszociatív tömbök, melynek tartalmát a PHP értelmező kezeli és tölti fel.
     *      $_POST  - POST metódussal érkezett adatok, indexek az űrlapok name attribútum értékei, alapból üres
     *      $_GET   - GET metódussal érkezett adatok, indexei az URL-ben meghatározott GET paraméterek, alapból üres
     *      $_FILES - Űrlapról történő feltöltött fájlok adatai, alapból üres
     * 
     *  Általánosan szükséges vezérlési szerkezetek, függvények:
     *  if(logikai feltetel[ek]):
     *     igaz ághoz tartozó PHP kód
     *  else:
     *      hamis ághoz tartozó PHP kód, opcionális az else ág elhagyható
     *  endif;
     * 
     * foreach ciklus kifejezetten tömbök bejárására szolgáló szerkezet, egyesével bejárja a tömb elemeit
     * foreach($tomb as $index=>$ertek):
     *      ciklusmag;
     * endforeach;
     * 
     * isset($valtozo) - fv. paraméternek megadott változó vagy tömbelem létezését vizsgálja true,false értékkel tér vissza
     * empty($valtozo) - fv. LÉTEZŐ változó vagy tömbelem tartalmát vizsgálja, ha üres true, különben false
     * 
     * SECURITY KOCKÁZATOK
     *  XSS támadás - HTML, CSS, JavaScript érvényesítése az oldalon, védekezés ellene:
     *      htmlspecialchars('szöveg') - HTML TAG jeleket (<,>) html entitássá (&lt; , &gt;) alakítja
     * 
     *  SQL injekció - SQL kód érvényesítése az adatbázis szerveren, védekezés ellene:
     *      real_escape_string('szöveg') - A szövegben lévő különbözö idézőjeleket védi le: ' --> \' , " --> \"
     *      
     */

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery forrás https://jquery.com/ -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap forrás https://getbootstrap.com/ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- DataTables forrás https://datatables.net/ -->
    <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        //DOM betöltésének várása a script futtatása előtt
        $(function(){
            //DataTable inicializálása, magyar fordítással
            let table = new DataTable('#read-table',{
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/hu.json',
                }
            });
        });
    </script>

    <title>Gyakorlat</title>
</head>
<body>
    <div class="container-fluid">
    <?php include_once 'elements/menu.php' ?>
    <!-- AJAX üzenetek konténere -->
    <div id="ajax-uzenet"></div>
    <?php 
        if(isset($_GET['oldal']))
        {
           //vizsgálom az oldal állomány létezését
           $oldal = 'views/' . $_GET['oldal'] . '.php';
           if(file_exists($oldal))
           {
             //létezik az állomány
             include($oldal);
           }
           else
           {
             //nem létező állomány
             include('views/404error.php');
           }
        }
        else
        {
           //ha nem létezik a oldal index a get tömbben
          //inlcude utasítás: forrás állomány importálása
          include('views/home.php');
        }
      ?>
    </div>
</body>
</html>