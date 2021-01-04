<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Sve zelje</title>
</head>
<body>
<div class="container mt-5">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Grad</th>
            <th>Bili ste dobri?</th>
            <th>Zelje</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $files = scandir(__DIR__."/zelje_db");
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $path = __DIR__. '/zelje_db\/' . $file;
            $fp = fopen("$path","r");
            $data = json_decode(fread($fp,filesize("$path")));
            fclose($fp);
            // var_dump ($data);
            echo "<tr>
            <td>$data->Ime</td>
            <td>$data->Prezime</td>
            <td>$data->Grad</td>
            <td>$data->Dobri</td>
            <td>$data->Zelje</td>
            </tr>";
        }
        ?>
    </tbody>
</table>    
</div>
</body>
</html>