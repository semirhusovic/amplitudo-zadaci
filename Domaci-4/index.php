<?php
$gradovi = ['Andrijevica','Bar','Berane','BijeloPolje','Budva', 'Cetinje','Danilovgrad','HercegNovi','Kolasin','Kotor','Mojkoviac','Niksic','Plav','Pljevlja','Pluzine','Podgorica','Rozaje','Savnik','Tivat','Ulcinj','Zabljak'];
?>

<!DOCTYPE html>
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
    <input type="text" class="form-control" id="ime" name="ime" placeholder="Marko">
  </div>
  <div class="form-group">
    <label for="prezime">Prezime</label>
    <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Markovic">
  </div>
  <div class="form-group">
    <label for="gradovi">Izaberite grad</label>
    <select class="form-control" name="izabraniGrad" id="gradovi">
    <?php 
                foreach ($gradovi as $grad) {
                    echo "<option value={$grad}>{$grad}</option>";
                }
            ?> 
    </select>
  </div>
  <div class="form-group">
    <label for="zelje">Unesite zelju</label>
    <textarea class="form-control" id="zelje" name="zelje" rows="3"></textarea>
  </div>
  <div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="cbox" name="cbox">
        <label class="form-check-label" for="cbox">Da li ste bili dobri?</label>
    </div>
  </div>
  <button class="btn btn-primary btn-block">Posalji</button>
</form>
</div>


</body>
</html>
