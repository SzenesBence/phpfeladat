<?php
//felhasználói adatok lekérése
    $sql = "SELECT * FROM users WHERE id='{$_GET['uid']}'";
    $query = $mysql->query($sql);

    if($query->num_rows):
        $f = $query->fetch_assoc();
    else:
?>
    <div class="alert alert-danger">A felhasználó nem létezik</div>
<?php return; endif; ?>
<div class="card">
    <div class="card-header bg-info text-white">Adatok frissítése</div>
    <div class="card-body">
        <form id="userupdate">
            <input type="hidden" name="user_id" value="<?=$f['id']?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Vezetéknév</label>
                    <input type="text" name="vezeteknev" class="form-control" value="<?=$f['vezeteknev']?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Keresztnév</label>
                    <input type="text" name="keresztnev" class="form-control" value="<?=$f['keresztnev']?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">E-mail*</label>
                    <input type="email" name="email" class="form-control" value="<?=$f['email']?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Felhasználónév*</label>
                    <input type="text" name="felhasznalonev" class="form-control" value="<?=$f['felhasznalonev']?>">
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
                    <input type="radio" name="neme" class="form-check-input" value="Nő" id="neme-no" <?=$f['neme']=='Nő'?'checked':null?>>
                    <label for="neme-no" class="form-check-label">Nő</label>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="">Születési év*</label>
                    <select name="szuletesiev" id="" class="form-select">
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
                                for($i=(date('Y')-90);$i<=(date('Y')-10);$i++): 
                            ?>
                                    <option value="<?=$i?>" <?=$f['szuletesiev']==$i?'selected':null?>><?=$i?></option>
                                <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="hirlevel" name="hirlevel" value="1" <?=$f['hirlevel']=='1'?'checked':null?>>
                        <label class="form-check-label" for="hirlevel">Hírlevél</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="">Leírás</label>
                    <textarea name="leiras" class="form-control" placeholder="Leírás szövege"><?=$f['leiras']?></textarea>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary">Frissítés</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#userupdate').on('submit',function(e){
            //HTTP szinkron működés kikapacsolása
            e.preventDefault();

            $.ajax({
                url:        "controllers/update.php",
                method:     "POST",
                dataType:   "JSON",
                data:       $('#userupdate').serialize()
            }).done(function(data){
                $('#ajax-uzenet').removeClass().addClass(data.class).text(data.uzenet);
            }).fail(function(){
                alert('Szerver hiba');
            });
        });
    });
</script>