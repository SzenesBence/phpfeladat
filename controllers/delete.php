<?php 
    //DB kapcsolat forrásának importálása
    require_once '../config/config.php';

    //Felhazsnáló törlésének kezelése
    /**
     * A Törlés űrlap elküldésének vizsgálata nem különbözik az INSERT űrlap vizsgálatától
     * Az űrlapon egy hidden típusú input elem tartalmazza a felhasználó elsődleges kulcsát,
     * mely csakis egyedi érték lehet az adatbázisban, és megjelenik a PHP oldalon a value attribútum értéke
     * ennek az input TAG-nek a name attribútum értékét vizsgálom isset() fv-nyel, az adatokat POST metóduson küldöm
     */
    
        /**
         * Az input mező rejtett a megjelenítésben, 
         * ettől függetlenűl SQL injekcióra meg kell vizsgálni,
         * léteznek olyan böngészőpluginok, amelyek lehetővé teszik a rejtett mező szerkesztését,
         * így bármilyen adat érkezhet a felhasználótól, ebben az esetben csakis számadatot kell elfogadnunk,
         * mert az elsődleges kulcs csakis pozitív egész szám lehet a MySQL szerveren
         * is_numeric() fv. a paraméterben megadott értéket vizsgálja, típustól függetlenül, hogy milyen karaktereket tartalmaz,
         * ha csak számok akkor true, más karakter esetén false értékkel tér vissza, 
         * így kizárt az SQL injekció a használatával a jelen szituációban
         */

         if(isset($_POST['user_id']) && is_numeric($_POST['user_id']))
         {
            $sql = "DELETE FROM users WHERE id='{$_POST['user_id']}'";

            if($mysql->query($sql))
            {
                print json_encode(["uzenet"=>"Sikeres törlés","class"=>"alert alert-success","user_id"=>$_POST['user_id']]);
                return;
            }
         }
    
?>