<?php
include("includes/db.inc.php");
include("includes/config.inc.php");
  $msg="";
if (count($_POST)>0) {
  //te($_POST);
  $sql = "
  INSERT INTO tbl_kunden (Vorname, Nachname, EmailAdresse,Passwort,GebDatum,TelNummer,Ort,PLZ,ErscheinungsJahr,Beginn,Ende)
  VALUES (
    '".$conn->real_escape_string($_POST['vorname'])."',
    '". $conn->real_escape_string($_POST['nachname'])."',
     '". $conn->real_escape_string($_POST['emailadresse'])."',
     '". $conn->real_escape_string($_POST['passwort'])."',
     '". $conn->real_escape_string($_POST['gebdatum'])."',
     '". $conn->real_escape_string($_POST['tell'])."',
     '". $conn->real_escape_string($_POST['ort'])."',
    '". $conn->real_escape_string($_POST['plz'])."',
    '". $conn->real_escape_string($_POST['jahr'])."',
    '". $conn->real_escape_string($_POST['beginn'])."',
    '". $conn->real_escape_string($_POST['ende'])."'
      )
  ";

  if ($conn->query($sql) === TRUE) {
    $msg="<p class='sucsses'>Ihre Datensaetze sind erfolgreich eingefuegen</p>";
  } else {
      $msg="Error: " . $sql . "<br>" . $conn->error;
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
     <?php echo $msg; ?>
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
      <th scope="col">Beginn</th>
      <th scope="col">Ende</th>
    </tr>
  </thead>
  <tbody>
<div class="center ">
    <form class="" action="" method="post">
  <div class="mb-3">
    <label for="vorname" class="form-label">Vorname</label>
    <input type="text" class="form-control" id="vorname"  name="vorname">
  </div>
  <div class="mb-3">
    <label for="nachname" class="form-label">Nachname</label>
    <input type="text" class="form-control" id="nachname"  name="nachname">
  </div>
  <div class="mb-3">
    <label for="emailadresse" class="form-label">EmailAdresse</label>
    <input type="text" class="form-control" id="emailadresse"  name="emailadresse">
  </div>
  <div class="mb-3">
    <label for="passwort" class="form-label">Passwort</label>
    <input type="text" class="form-control" id="passwort"  name="passwort">
  </div>
  <div class="mb-3">
    <label for="gebdatum" class="form-label">GebDatum</label>
    <input type="date" class="form-control" id="gebdatum"  name="gebdatum">
  </div>
  <div class="mb-3">
    <label for="tell" class="form-label">TellNummer</label>
    <input type="number" class="form-control" id="tell"  name="tell">
  </div>
  <div class="mb-3">
    <label for="ort" class="form-label">Ort</label>
    <input type="text" class="form-control" id="ort"  name="ort">
  </div>
  <div class="mb-3">
    <label for="plz" class="form-label">PLZ</label>
    <input type="number" class="form-control" id="plz"  name="plz">
  </div>
  <div class="mb-3">
    <label for="jahr" class="form-label">ErscheinungsJahr</label>
    <input type="number" class="form-control" id="jahr"  name="jahr">
  </div>
  <div class="mb-3">
    <label for="beginn" class="form-label">Beginn</label>
    <input type="date" class="form-control" id="beginn"  name="beginn">
  </div>
  <div class="mb-3">
    <label for="ende" class="form-label">Ende</label>
    <input type="date" class="form-control" id="ende"  name="ende">
  </div>

  <div class="mb-3">
    <input type="submit" class="form-control" value="senden">
  </div>

    </form>
    </div>
    <?php
    $sql="
    SELECT * FROM tbl_kunden
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
}


     ?>
  </tbody>
</table>
   </body>
 </html>
