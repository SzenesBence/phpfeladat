<?php 
    require_once '../config/config.php';

    if(isset($_POST['vezeteknev']))
        {
            //kötelező mezők vizsgálata

            if
            (
                empty($_POST['email'])          ||
                empty($_POST['felhasznalonev']) ||
                empty($_POST['szuletesiev'])
            )
            {
                print json_encode(["uzenet"=>"Kötelező mezők","class"=>"alert alert-danger"]);
                return;
            }

            $hirlevel = 0;
            //XSS, SQL védelem
            foreach($_POST as $index=>$ertek)
            {
                //dinamikus valt. léteehozás $$
                $$index = htmlspecialchars($mysql->real_escape_string($ertek));
            }

            //email és felhasznalonev egyedisege
            $sql = "SELECT email FROM users WHERE email='{$email}' AND id<>'{$user_id}'";

            $select = $mysql->query($sql);
            if($select->num_rows)
            {
                print json_encode(["uzenet"=>"Email cím foglalt","class"=>"alert alert-danger"]);
                return;
            }

            $sql = "SELECT felhasznalonev FROM users WHERE felhasznalonev='{$felhasznalonev}' AND id<>'{$user_id}'";

            $select = $mysql->query($sql);
            if($select->num_rows)
            {
                print json_encode(["uzenet"=>"Felhasználónév foglalt","class"=>"alert alert-danger"]);
                return;
            }

            if(!empty($jelszo) || !empty($jelszoujra))
            {

                //jelszó ellen.
                if($jelszo != $jelszoujra)
                {
                    print json_encode(["uzenet"=>"A jelszavak nem egyeznek","class"=>"alert alert-danger"]);
                    return;
                }

                //jelszó
                $jelszo = hash('sha256',$jelszo.$zaj);

                $sql = "UPDATE users SET vezeteknev='{$vezeteknev}',keresztnev='{$keresztnev}',email='{$email}',felhasznalonev='{$felhasznalonev}',jelszo='{$jelszo}',neme='{$neme}',szuletesiev='{$szuletesiev}',hirlevel='{$hirlevel}',leiras='{$leiras}' WHERE id='{$user_id}'";
            }
            else
            {
                $sql = "UPDATE users SET vezeteknev='{$vezeteknev}',keresztnev='{$keresztnev}',email='{$email}',felhasznalonev='{$felhasznalonev}',neme='{$neme}',szuletesiev='{$szuletesiev}',hirlevel='{$hirlevel}',leiras='{$leiras}' WHERE id='{$user_id}'";
            }

            
            if($mysql->query($sql))
            {
                //sikeres insert
                print json_encode(["uzenet"=>"Sikeres frissítés","class"=>"alert alert-success"]);
                return;
                
            }
            else
            {
                print $mysql->error;
            }
        }
        
    
?>