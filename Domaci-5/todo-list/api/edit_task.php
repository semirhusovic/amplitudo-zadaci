<?php
include('../funkcije.php');
$todos = json_decode(file_get_contents('../todo.db'), true);

if (isset($_POST['taskid']) && $_POST['taskid'] != "") {
    $taskid = $_POST['taskid'];
} else {
    exit("Pogresan ID!");
}

if (isset($_POST['tasktekst']) && $_POST['tasktekst'] != "") {
    $tasktekst = $_POST['tasktekst'];
} else {
    exit("Niste unijeli tekst!");
}
if (isset($_POST['taskopis']) && $_POST['taskopis'] != "") {
    $taskopis = $_POST['taskopis'];
} else {
    exit("Niste unijeli opis!");
}

if (nadjiZadatak($taskid) !== FALSE) {
    $index = nadjiZadatak($taskid);
} else {
    exit("Ne postoji zadatak sa predatim ID-jem...");
}

$todos[$index]['tekst'] = $tasktekst;
$todos[$index]['opis'] = $taskopis;

if (!(file_put_contents('../todo.db', json_encode($todos)))) {
    exit("Doslo je do greske pri upisu u bazu podataka!");
};
