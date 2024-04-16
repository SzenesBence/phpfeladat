<div class="card">
    <div class="card-header bg-primary text-white">Adatok listázása</div>
    <div class="card-body">
        <?php
            /**
             * SELECT SQL, * maszkos lekérés, 
             * az adott táblából (users) minden mezőadatok lekérünk
             */
            
             $sql = "SELECT * FROM users";
             $select = $mysql->query($sql);
        ?>
        <table class="table" id="read-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Név</th>
                    <th>Felhasználónév</th>
                    <th>E-mail</th>
                    <th>Neme</th>
                    <th>születési év</th>
                    <th>Hírlevél</th>
                    <th>Leírás</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /**
                     * while ciklus, a ciklus addig fut mig a kifejezés true értékkel tér vissza, 
                     *  így a kifejezésben biztosítani kell, hogy véges lépés után false értékkel térjen vissza.
                     * while (kifejezés):
                     *   ciklusmag
                     * endwhile;
                     * 
                     * fetch_assoc() metódus
                     *  A SELECT SQL lefutás után az DB szerver egy objektummal tér visszam, 
                     *      amely egy adathalmazra mutat, ezt az adathalmazt kell bejárnunk a while ciklus segítségével
                     *      amely során a fetch_assoc() metódus a soron következő rekord adatait adja vissza 
                     *      egy asszociatív tömben, amelyben az indexek a SELECT-ben megadott tábla lekért mezőnevei
                     */

                     while($user = $select->fetch_assoc()):
                ?>
                    <tr id="usertr-<?=$user['id']?>">
                        <td><?=$user['id']?></td>
                        <td><?=$user['vezeteknev']?> <?=$user['keresztnev']?></td>
                        <td><?=$user['felhasznalonev']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['neme']?></td>
                        <td><?=$user['szuletesiev']?></td>
                        <td><?=$user['hirlevel']?'Kér':'Nem kér'?></td>
                        <td><?=$user['leiras']?></td>
                        <td>
                            <a href="?oldal=update&uid=<?=$user['id']?>" class="btn btn-primary w-100 mb-3">
                                Frissítése
                            </a>
                            <form class="userdelete">
                                <input type="hidden" name="user_id" value="<?=$user['id']?>">
                                <button class="btn btn-danger w-100" onclick="return confirm('Biztosan törli a felhasználót?')">Törlés</button>
                            </form>
                        </td>

                    </tr>

                <?php endwhile ?>
             
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        $('.userdelete').on('submit',function(e){
            //HTTP szinkron működés kikapacsolása
            e.preventDefault();
            var formthis = this;

            $.ajax({
                url:        "controllers/delete.php",
                method:     "POST",
                dataType:   "JSON",
                data:       $(formthis).serialize()
            }).done(function(data){
                $('#ajax-uzenet').removeClass().addClass(data.class).text(data.uzenet);
                $(`#usertr-${data.user_id}`).remove();
            }).fail(function(){
                alert('Szerver hiba');
            });
        });
    });
</script>