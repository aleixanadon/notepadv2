<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'notepad')
or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$title = '';
$note = '';

// S U B M I T - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if (isset($_POST["submit"])) {

     $title = $_POST["title"];
     $note = $_POST["note"];

     $mysqli->query("INSERT INTO `notes` (title, note) VALUES ('$title', '$note')")
     or die($mysqli->error());

     $_SESSION["msg"] = "S'ha afegit una nova nota";
     $_SESSION["msg_type"] = "Èxit!";

     header("Location: index.php");
}

// D E L E T E - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if (isset($_GET["delete"])) {

     $id = $_GET["delete"];

     $mysqli->query("DELETE FROM `notes` WHERE id = $id")
     or die($mysqli->error());

     $_SESSION["msg"] = "S'ha esborrat una nota";
     $_SESSION["msg_type"] = "Compte!";

     header("Location: index.php");
}

// E D I T - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if (isset($_GET["edit"])) {

     $id = $_GET["edit"];
     $update = true;

     $result = $mysqli->query("SELECT * FROM notes WHERE id = $id")
     or die($mysqli->error());

     if (count((array)$result) == 1) { //????
          $row = $result->fetch_array();
          $title = $row["title"];
          $note = $row["note"];

          header("Location: index.php");
     }
}

// U P D A T E - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if (isset($_POST["update"])) {
     $id = $_POST["id"];
     $title = $_POST["title"];
     $note = $_POST["note"];

     $mysqli->query("UPDATE notes SET title = '$title', note = '$note' WHERE id = $id")
     or die($mysqli->error());

     $_SESSION["msg"] = "Nota actualitzada";
     $_SESSION["msg_type"] = "Actualització!";

     header("Location: index.php");
}
?>
