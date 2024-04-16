<?php
    /**
     * Adatbáziskapcsolat beállítás
     * Csatlakozás az SQL szerverhez, adatbázis specifikus, objektumorinetált módszerrel
     */
    //Paraméterek felvétele
    $host = "localhost"; //MySql szerver elérhetősége
    $user = "intgyak2024";
    $pass = "lT[L3*htjj7v8uTo";
    $db   = "intgyak2024"; //adatbázis neve, amihez kapcsolódni kívánunk

    /**
     * kapcsolat hívása, a new operátorral a PHP beépített mysqli osztályából egy objektumot hozunk létre, 
     * későbbiekben ebből az objektumokból fogunk adatbázis specifikus metódusokat és tagváltozókat meghívni
     * 
     * A $user-ben megadott felhasználónak, hozzáféréssel kell rendelkeznie a $db-ben megadott adatbázishoz
     */

    $mysql = new mysqli($host,$user,$pass,$db);


    $zaj = "DFGR_Etv8379rgvidrgvrgRTFHBTRHERFvwoifr98jarz89zgregRTU=uivu3a89rzaifhgiougjowefZJBrfwavzrfa uieszf";

    //kapcsolat ellenőrzése
    
?>
