<?php 
$errors = array(); 
$ime=$_POST["ime"];
$prezime=$_POST["prezime"]; 
$grad=$_POST["izabraniGrad"]; 
if(isset($_POST['cbox'])) {
    $dobri=$_POST["cbox"] == 'on' ? 'Da' : 'Ne'; 
} else {
    $dobri= false;
}
$zelje=$_POST["zelje"]; 

function checkIme ($ime) {
    global $errors;
    $slova='qwertyuiopasdfghjklzxcvbnmšđčćžQWERTZUIOPASDFGHJKLYXCVBNMŠĐČĆŽ';
    if($ime == '') {
        $errors[] = 'Ime ne smije biti prazno!';
    } else {
    for($i=0;$i<strlen($ime);$i++) {
        if(strpos($slova,$ime[$i]) == false) {
            $errors[] = 'Ime ne smije sadržati brojeve ni specijalne karaktere!';
            break;
        }
    }
}
}
function checkPrezime ($prezime) {
    global $errors;
    $slova ='qwertyuiopasdfghjklzxcvbnmšđčćžQWERTZUIOPASDFGHJKLYXCVBNMŠĐČĆŽ';
    if($prezime == '') {
        $errors[] = 'Prezime ne smije biti prazno!';
    } else {
    for($i=0;$i<strlen($prezime);$i++) {
        if(strpos($slova,$prezime[$i]) == false) {
            $errors[] = 'Prezime ne smije sadržati brojeve ni specijalne karaktere!';
            break;
        }
    }
}
}
function checkDobri ($dobri) {
    global $errors;
    if($dobri != 'Da') {
        $errors[] = 'Niste bili dobri!';
    } else {
        return 1;
    };
}
if($zelje == '' ) {
    $errors[] = 'Morate da unesete želju :P';
}
checkIme($ime); 
checkPrezime($prezime);
checkDobri($dobri);
if (count($errors) == 0) {
    if (!file_exists(__DIR__."/zelje_db")) {
        mkdir(__DIR__."/zelje_db", 0755, true);
    }
    $id = uniqid();
    $imeFajla = __DIR__."/zelje_db/$id.txt";
            $input = json_encode(["Ime"=>"$ime", "Prezime"=>"$prezime", "Grad"=>"$grad","Dobri"=>"$dobri","Zelje"=>"$zelje"]);
            $fp = fopen("$imeFajla","wb");
            if( $fp == false ){
                echo 'Doslo je do greske. Fajl nije otvoren';
            }else{
                fwrite($fp,$input);
                fclose($fp);
                header("Location: zelja_poslata.html");
            }
} else {
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Pocetna stranica</title>
</head>
<body>
<div class="container mt-5">
<form action="sacuvaj_zelju.php" method="POST">
  <div class="form-group">
    <label for="ime">Ime</label>
    <input type="text" class="form-control" required id="ime" name="ime" placeholder="Marko" value="'.htmlspecialchars($ime).'">
  </div>
  <div class="form-group">
    <label for="prezime">Prezime</label>
    <input type="text" class="form-control" required id="prezime" name="prezime" placeholder="Markovic" value="'.htmlspecialchars($prezime).'">
  </div>
  <div class="form-group">
    <label for="gradovi">Izaberite grad</label>
    <select class="form-control" name="izabraniGrad" id="gradovi">
 <option>'.htmlspecialchars($grad).'</option>
    </select>
  </div>
  <div class="form-group">
    <label for="zelje">Unesite zelju</label>
    <textarea class="form-control" id="zelje" name="zelje" rows="3" value="'.htmlspecialchars($zelje).'">'.$zelje.'</textarea>
  </div>
  <div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="cbox" name="cbox" checked="'.htmlspecialchars($dobri).'">
        <label class="form-check-label" for="cbox">Da li ste bili dobri?</label>
    </div>
  </div>
  <button class="btn btn-primary btn-block">Posalji</button>
</form>
' ;
echo '<div class="alert alert-danger mt-3" role="alert">';
foreach($errors as $error) {
    echo '<p class="error"><b>'.$error.'</b></p>'; 
}
echo '</div>
</div>
</body>
</html>';
}

?>  