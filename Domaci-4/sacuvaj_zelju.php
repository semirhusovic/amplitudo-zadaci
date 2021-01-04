<?php  
$ime=$_POST["ime"];
$prezime=$_POST["prezime"]; 
$grad=$_POST["izabraniGrad"]; 
$dobri=$_POST["cbox"] == 'on' ? 'Da' : 'Ne'; 
$zelje=$_POST["zelje"]; 

function checkIme ($ime) {
    if(!ctype_alpha($ime)) {
        header("Location: index.php");
        exit();
    } else {
        return 1;
    };
}
function checkPrezime ($prezime) {
    if(!ctype_alpha($prezime)) {
        header("Location: index.php");
        exit();
    } else {
        return 1;
    };
}

function checkDobri ($dobri) {
    if($dobri != 'Da') {
        header("Location: index.php");
        exit();
    } else {
        return 1;
    };
}
if (checkIme($ime) && checkPrezime($prezime) && checkDobri($dobri)) {
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
}

?>  