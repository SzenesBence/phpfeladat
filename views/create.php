<?php

    /**
     * HTML ÜRLAPOK KEZELÉSE PHP SZKRIPTTEL
     * 
     * A kliensoldalról adatokat küldeni HTTP protokollal a HTTP metódusok segítségével lehet.
     *      Alapértelmezetten a HTTP a GET lekérő metódust használja, amit az URL-ben lehet paraméterezni
     *  pl: https://www.google.hu/search?q=PHP
     *  A példában a https://www.google.hu/search a webcím, 
     *  kérdőjel után (?) a q betű a paraméter elnevezése, értéke PHP. 
     *  További paramétereket hozzáfűzni az első után az & (&amp;) jellel lehetséges.
     *  A GET paramétereket renszerint adatbázisból történő lekérdezésekkor használjuk.
     * 
     *      POST HTTP metódus. 
     *  HTML űrlapról történő adatküldés, 
     *  amelyeket rendszerint adatbázisba mentünk POST metódussal
     *      <form method="POST"> .... </form>
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
     * foreach ciklus kifejezetten tömbök bejárására szolgáló iteráció szerkezet, egyesével bejárja a tömb elemeit
     * foreach($tomb as $index=>$ertek):
     *      ciklusmag;
     * endforeach;
     * 
     * isset($valtozo) - fv. paraméternek megadott változó vagy tömbelem létezését vizsgálja boolean értékkel tér vissza
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
<div class="card">
    <div class="card-header bg-success text-white">Regisztráció</div>
    <div class="card-body">
        <form method="POST" id="regform">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="">Vezetéknév</label>
                    <input type="text" name="vezeteknev" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Keresztnév</label>
                    <input type="text" name="keresztnev" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">E-mail*</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Felhasználónév*</label>
                    <input type="text" name="felhasznalonev" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Jelszó*</label>
                    <input type="password" name="jelszo" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Jelszó újra*</label>
                    <input type="password" name="jelszoujra" class="form-control">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="">Neme</label>
                    <input type="radio" name="neme" class="form-check-input" value="Férfi" checked id="neme-ferfi">
                    <label for="neme-ferfi" class="form-check-label">Férfi</label>

                    <input type="radio" name="neme" class="form-check-input" value="Nő" id="neme-no">
                    <label for="neme-no" class="form-check-label">Nő</label>
                </div>
                
                <div class="col-md-2 mb-3">
                    <label for="">Születési év*</label>
                    <select name="szuletesiev" id="" class="form-select" required>
                        <option value="">-- Választás --</option>
                        <?php
                            /**
                             * FOR vezérlési szerkezet, léptető/számláló ciklus
                             * for(ciklusvaltozo;feltetel;leptetes)
                             * {
                             *      kodblokk/ciklusmag
                             * }
                             * for(ciklusvaltozo;feltetel;cvleptetese):
                             *      kodblokk/ciklusmag
                             * endfor;
                             */
                            for($i=(date('Y')-90);$i<=(date('Y')-10);$i++): ?>
                                <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="hirlevel" name="hirlevel" value="1">
                        <label class="form-check-label" for="hirlevel">Hírlevél</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="">Leírás</label>
                    <textarea name="leiras" class="form-control" placeholder="Leírás szövege"></textarea>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary">Regisztrálás</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#regform').on('submit',function(e){
            //HTTP szinkron működés kikapacsolása
            e.preventDefault();

            $.ajax({
                url:        "controllers/create.php",
                method:     "POST",
                dataType:   "JSON",
                data:       $('#regform').serialize()
            }).done(function(data){
                $('#ajax-uzenet').removeClass().addClass(data.class).text(data.uzenet);
            }).fail(function(){
                alert('Szerver hiba');
            });
        });
    });
</script>