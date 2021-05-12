<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>otroblocdenotas</title>
          <link rel="stylesheet" href="index.css">
          <link rel="preconnect" href="https://fonts.gstatic.com">
          <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
     </head>
     <body>
          <?php
               require_once 'process.php';

               $mysqli = new mysqli('localhost', 'root', '', 'notepad') or die(mysqli_error($mysqli));
               $result = $mysqli->query("SELECT * FROM notes");
          ?>

          <?php
               if (isset($_SESSION["msg"])) {
                    echo "<div>";
                         echo $_SESSION["msg"];
                         unset($_SESSION["msg"]);
                    echo "</div>";
               }
          ?>

          <header>
               <section>
                    <img src="pixil-frame-0 (3).png" alt="Pixel Art Logo">
                    <h1>Bloc de notes</h1>
               </section>

               <section>
                    <a href="#">Instruccions</a>
                    <a href="#">About</a>
               </section>
          </header>


          <form action="process.php" method="post">
               <input type="hidden" name="id" value="<?php echo $id; ?>">

               <input type="text" name="title" value="<?php  echo $title; ?>" placeholder="Títol de la nota">
               <input type="text" name="note" value="<?php echo $note; ?>" placeholder="Introdueix la teva nota">

               <?php
                    if ($update == true) {

                         echo '<button type="submit" name="update">Update</button>';
                    } else if ($update == false) {

                         echo '<button type="submit" name="submit">Submit</button>';
                    }
               ?>
          </form>

          <table>
               <tr>
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Nota</th>
               </tr>
               <hr>
               <?php

               while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                         /*echo "<td>" . $row["id"] . "</td>";*/
                         echo "<td>" . $row["title"] . "</td>";
                         echo "<td>" . $row["note"] . "</td>";
                         echo '<td><a href="index.php?edit=' . $row['id'] . '">' . 'Edit' . '</a></td>';
                         echo '<td><a href="process.php?delete=' . $row['id'] . '">' . 'Delete' . '</a></td>';
                    echo "</tr>";
               }

               ?>
          </table>
     </body>
</html>
