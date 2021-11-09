<?php
include("includes/db.inc.php");
include("includes/config.inc.php");
if (count($_POST)==0) {
  $_POST['von']="";
  $_POST['bis']="";
}
$sqlw="";
if (count($_POST)>0) {
  te($_POST);
  $arr=array();
  if (strlen($_POST['von'])>0) {
    $arr[]="tbl_kunden.Beginn >=' ". $_POST['von'] ."'";
  }
  if (strlen($_POST['bis'])>0) {
    $arr[]="tbl_kunden.Ende <=' ". $_POST['bis'] ."'";
  }
  if (count($arr)>0) {
    $sqlw="
    WHERE(
      ". implode(" AND ",$arr)."
      )
    ";
  }

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
      .sucsses{
        border: 1px solid gray;
        background: green;
        font-size: 24px;
        font-weight: normal;
          width: 30%;
            margin: auto;
            margin-top: 2rem;
      }
      .error{
          border: 1px solid gray;
          background: red;
          font-size: 24px;
          font-weight: normal;
            width: 30%;
              margin: auto;
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
      <th scope="col">ErscheinungsJahr</th>
      <th scope="col">Datum Von</th>
      <th scope="col">Datum Bis</th>
    </tr>
  </thead>
  <tbody>
<div class="center ">
    <form class="" action="" method="post">
  <div class="mb-3">
    <label for="von" class="form-label">Datum Von</label>
    <input type="date" class="form-control" id="von"  name="von" value="<?php echo $_POST['von'] ?>">
  </div>
  <div class="mb-3">
    <label for="bis" class="form-label">Datum Bis</label>
    <input type="date" class="form-control" id="bis"  name="bis" value="<?php echo $_POST['bis'] ?>">
  </div>
  <div class="mb-3">
    <input type="submit" class="form-control" value="senden">
  </div>
    </form>
    </div>
    <?php
    $sql="
    SELECT * FROM tbl_kunden
    ". $sqlw ."
    ORDER BY tbl_kunden.Nachname DESC
    ";
    $kunden = $conn->query($sql) or die("Fehler in der Query:". $conn->error);

if ($kunden->num_rows > 0) {
  // output data of each row
  while($kunde = $kunden->fetch_assoc()) {
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
      <td>'. $kunde['ErscheinungsJahr'].'</td>
      <td>'. $kunde['Beginn'].'</td>
      <td>'. $kunde['Ende'].'</td>
    </tr>
    ';
  }
}else {
  echo "<p class='error'> Für dieser Datum gib es keine Kunde<p>";
}


     ?>
  </tbody>
</table>
   </body>
 </html>
