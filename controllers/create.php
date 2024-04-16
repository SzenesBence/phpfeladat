<?php
    //Adatbáziskacsolódás forrásának beemelése
    require_once '../config/config.php';
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

    /**
     * ADATKÜLDÉS FELDOLGOZÁSA MENTÉSRE PHP OLDALON:
     */
    //Az isset fv.-nyel vizsgálom, hogy megjeleni-e a $_POST tömbben az elküldött űrlap valamely name attribútum értéke, pl vezeteknev
    
     
        //Vizsgálom az empty fv.-nyel, hogy a kötelező mezők nem üresen érkeztek meg, azaz a regisztráló kitöltötte
        

        //SQL injekció és XSS támadás védése
        /**
         * XSS - HTML, CSS, JavaScript kód érvényesítése az oldalon
         *      htmlspecialchars() - sztringet tisztítja meg a HTML TAG nyitó és záró
         *          jelektől (<,>) < = &lt; > = &gt;
         * 
         * SQL injekció real_escape_string()
         *  sztringben lévő határolójeleket (', ", `) védi le: (\', \", \`)
         */
        //A checkbox és radio típusú input elmek name attribútum értékei nem kerülnek átadásra, nincs bejelölve a mező az űrlapon
        $hirlevel = 0;
            /**
             * dinamikus változólétrehozás: $$
             * pl. 
             * $a = 'alma';
             * $$a = 'gyümölcs'; //létrejött dinamikusan a $alma változó, melynek tartalma gyümölcs
             *
             * Minden input elem name attribútum értékéből egy változót generálunk dinamikusan, 
             * így már nem kell a $_POST tömbből hívatkozni a küldött adatokra, 
             * az így kapott változók a megtisztított szöveget tartalmazzák
             */
            

        //jelszavak egyeznek?
        

        //felhasználói név és email cím egyediségének vizsgálata az adatbázsiban
        
        
        //A jelszót soha nem plaintext formában tároljuk, mindig HASH algoritmust használjunk
        

        //INSERT SQL
        

        //SQL szkript futtatása az SQL szerveren

        if(isset($_POST['vezeteknev']))
        {
            //kötelező mezők vizsgálata

            if
            (
                empty($_POST['email'])          ||
                empty($_POST['felhasznalonev']) ||
                empty($_POST['jelszo'])         ||
                empty($_POST['jelszoujra'])     ||
                empty($_POST['szuletesiev'])
            )
            {
                print json_encode(["uzenet"=>"Kötelező mezők","class"=>"alert alert-danger"]);
                return;
            }

            //XSS, SQL védelem
            foreach($_POST as $index=>$ertek)
            {
                //dinamikus valt. léteehozás $$
                $$index = htmlspecialchars($mysql->real_escape_string($ertek));
            }

            //jelszó ellen.
            if($jelszo != $jelszoujra)
            {
                print json_encode(["uzenet"=>"A jelszavak nem egyeznek","class"=>"alert alert-danger"]);
                return;
            }

            //email és felhasznalonev egyedisege
            $sql = "SELECT email FROM users WHERE email='{$email}'";

            $select = $mysql->query($sql);
            if($select->num_rows)
            {
                print json_encode(["uzenet"=>"Email cím foglalt","class"=>"alert alert-danger"]);
                return;
            }

            $sql = "SELECT felhasznalonev FROM users WHERE felhasznalonev='{$felhasznalonev}'";

            $select = $mysql->query($sql);
            if($select->num_rows)
            {
                print json_encode(["uzenet"=>"Felhasználónév foglalt","class"=>"alert alert-danger"]);
                return;
            }

            //jelszó
            $jelszo = hash('sha256',$jelszo.$zaj);

            $sql = "INSERT INTO users(vezeteknev,keresztnev,email,felhasznalonev,jelszo,neme,szuletesiev,hirlevel,leiras) VALUES
                ('{$vezeteknev}','{$keresztnev}','{$email}','{$felhasznalonev}','{$jelszo}','{$neme}','{$szuletesiev}','{$hirlevel}','{$leiras}')";
            
            if($mysql->query($sql))
            {
                //sikeres insert
                print json_encode(["uzenet"=>"Sikeres regisztráció","class"=>"alert alert-success"]);
                return;
                
            }
            else
            {
                print $mysql->error;
            }
        }
        
?>