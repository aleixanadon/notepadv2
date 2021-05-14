<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>otroblocdenotas</title>
          <link rel="stylesheet" href="index.css">
          <link rel="preconnect" href="https://fonts.gstatic.com">
          <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
          <link href="logo.png" rel="icon" type="image/png" />
          <script src="scripts.js"></script>
     </head>

     <body>

     <?php
          require_once 'process.php';

          $mysqli = new mysqli('localhost', 'root', '', 'notepad') or
          die(mysqli_error($mysqli));

          $result = $mysqli->query("SELECT * FROM notes");
     ?>

     <!-- S T A T U S --------------------------------------------------------->
     <?php
          if (isset($_SESSION["msg"])) {
               echo "<div>";
                    echo $_SESSION["msg"];
                    unset($_SESSION["msg"]);
               echo "</div>";
          }
     ?>
     <!-- H E A D E R --------------------------------------------------------->
     <header>
          <section>
               <img src="logo.png" alt="Logo Agenda">
               <h1><a href="index.php">Bloc de notes</a></h1>
          </section>

          <nav>
               <!-- AQUÍ PODRÍA INCLIUR LOS DOCUMENTOS QUE TENGO QUE TEDACTAR-->
               <a href="#">Instruccions</a>
               <a href="#">About</a>
          </nav>
     </header>

     <section>
          <article>
               <!-- F O R M --------------------------------------------------->
               <form action="process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <fieldset>
                         <legend>Introdueix una nota nova</legend>
                         <input type="text" name="title" value="<?php  echo $title; ?>" placeholder="Títol de la nota">
                         <!--<input type="text" name="note" value="" placeholder="Introdueix la teva nota">-->
                         <textarea name="note" rows="12" cols="37" value="<?php echo $note; ?>" placeholder="Introdueix aquí la teva nota"></textarea>
                    <?php
                         if ($update == true) {

                              echo '<button type="submit" id="update" name="update">Actualitzar la nota</button>';
                         } else if ($update == false) {

                              echo '<button type="submit" id="submit" name="submit">Afegir nota</button>';
                         }
                    ?>
                    </fieldset>
               </form>
          </article>

          <article>
               <!-- T A B L E ------------------------------------------------->
               <table>
                    <tr>
                         <!--<th>ID</th>-->
                         <th>Títol</th>
                         <th>Nota</th>
                    </tr>

                    <?php

                    while ($row = $result->fetch_assoc()) {
                         echo "<tr>";
                              /*echo "<td>" . $row["id"] . "</td>";*/
                              echo "<td>" . $row["title"] . "</td>";
                              echo "<td>" . $row["note"] . "</td>";
                              echo '<td><a href="index.php?edit=' . $row['id'] . '">' . 'Editar' . '</a></td>';
                              echo '<td><a href="process.php?delete=' . $row['id'] . '">' . 'Borrar' . '</a></td>';
                         echo "</tr>";
                    }

                    ?>
               </table>
          </article>

     </section>

     <footer>
          Creado por <u>Aleix</u> - Trabajo final
     </footer>

     </body>
</html>
