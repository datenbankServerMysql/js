<?php
include("includes/db.inc.php");
include("includes/config.inc.php");
if (count($_POST)==0) {
  $_POST['vorname']="";
  $_POST['nachname']="";
}
 ?>
 <!DOCTYPE html>
 <html lang="de">
   <head>
     <meta charset="utf-8">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <title></title>
     <style media="screen">
     .center {
      margin: auto;
      width: 50%;
      border: 2px solid gray;
      padding: 10px;
      margin-top: 2rem;
      }
     </style>
   </head>
   <header>
     <ul>
       <li> <a href="index.php">Home</a> </li>
        <li> <a href="datumSuch.php">Datum filtern</a> </li>
         <li> <a href="SuchVorNach.php">Kunden Filtern</a> </li>
     </ul>
   </header>

   <body>
     <div class="center ">
         <form class="" action="" method="post">
       <div class="mb-3">
         <label for="vorname" class="form-label">Vorname</label>
         <input type="text" class="form-control" id="vorname"  name="vorname" value="<?php echo $_POST['vorname'] ?>">
       </div>
       <div class="mb-3">
         <label for="nachname" class="form-label">Nachname</label>
         <input type="text" class="form-control" id="nachname"  name="nachname" value="<?php echo $_POST['nachname'] ?>" >
       </div>
       <div class="mb-3">
         <input type="submit" class="form-control" value="filtern">
       </div>
      </form>
       </div>
      <?php
      $sqlw="";
      if (count($_POST)>0) {
        //te($_POST);
        $arr= array();
        if (strlen($_POST['vorname'])>0) {
          $arr[]="tbl_kunden.Vorname LIKE '%". $_POST['vorname'] ."%'";
        }
        if (strlen($_POST['nachname'])>0) {
            $arr[]="tbl_kunden.Nachname LIKE '%". $_POST['nachname'] ."%'";
          }
if (count($arr)>0) {
  $sqlw="
    WHERE(
      " . implode(" AND ",$arr) . "
      )
  ";
}
  }else {
        $sqlw="";
        }

       ?>

     <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Vorname</th>
      <th scope="col">Nachname</th>
      <th scope="col">Emailadresse</th>
      <th scope="col">Password</th>
      <th scope="col">Gebdatum</th>
      <th scope="col">TelNummer</th>
      <th scope="col">Ort</th>
      <th scope="col">PLZ</th>
      <th scope="col">Beginn</th>
      <th scope="col">Ende</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql="
    SELECT * FROM tbl_kunden
    ". $sqlw  ."
    ";
    //te($sql);

$kunden = $conn->query($sql) or die("Fehler in der Query:". $conn->error);

if ($kunden->num_rows > 0) {
  // output data of each row
  while($kunde = $kunden->fetch_assoc()) {
      //te($kunde);
    echo '
    <tr>
      <td>'. $kunde['IDKunde'].'</td>
      <td>'. $kunde['Vorname'].'</td>
      <td>'. $kunde['Nachname'].'</td>
      <td>'. $kunde['EmailAdresse'].'</td>
      <td>'. $kunde['Passwort'].'</td>
      <td>'. $kunde['GebDatum'].'</td>
      <td>'. $kunde['TelNummer'].'</td>
      <td>'. $kunde['Ort'].'</td>
      <td>'. $kunde['PLZ'].'</td>
      <td>'. $kunde['Beginn'].'</td>
      <td>'. $kunde['Ende'].'</td>
      <td></td>
    </tr>
    ';
  }
}else {
  echo "<p>keine Kunde gibt es</p>";
}
     ?>
  </tbody>
</table>

   </body>
 </html>
