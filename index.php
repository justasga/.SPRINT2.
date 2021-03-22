<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
    require_once "connect.php"; 

?>
    <div class="up">
                <div class="links">
                        <a href="./?path=Darbuotojai">Darbuotojai</a>
                        <a href="./?path=Projektai">Projektai</a>
                </div>
                <div class="name">Projekto valdymas</div>
    </div>
    

<?php
$path = $_GET['path'];
    //join'ai darbuotoju
if($path == 'Darbuotojai'){

    $sql = "SELECT id, Vardas, projectName FROM darbuotojai
    LEFT JOIN projektai ON darbuotojai.projectID = projektai.projectID
    ORDER BY id";
    
    $result = mysqli_query($conn, $sql);

    // darbuotoju  lentele
    if(mysqli_num_rows($result) > 0) {
    ?>
    <?php
        print('<table id="table">');
        print('<thead>');
        print('<tr><th>Id</th><th>Vardas</th><th>Projektai</th><tr>');
        print('</thead><tbody>');
        while($row = mysqli_fetch_assoc($result)) {
        print('<tr><td>' . $row["id"] . '</td><td>' . $row["Vardas"]. '</td><td>' . $row["projectName"].   '</td></tr>');
        '<td>' . '<a href="?action=delete&id='  . $row['id'] . '"><button>DELETE</button></a>';
        }
        print('</tbody></table>');
        
?>
    <?php
        while($row = mysqli_fetch_assoc($result)) {
    ?>
                
     <?php
        }

    } else{
        echo "0 results";
    }
    ?>
        <!-- Irasyti naują darbuotoją-->
    <div class="container">
        <p>Pridėk darbuotoją:</p>

        <form class="form-inline m-2" action="createWorker.php" method="POST">
                <label for="name">Vardas:</label>
                <input type="text" class="form-control m-2" id="name" name="name">
                <!-- <label for="score">Projekto ID:</label>
                <input type="number" class="form-control m-2" id="projektoID" name="projektoID""> -->
                <button type="submit" class="btn btn-primary">Pridėti</button>
        </form>
    </div>

    <?php
    
    //joininimas projektu

} else if($path == 'Projektai') {

    $sql = "SELECT group_concat(darbuotojai.Vardas SEPARATOR ', ') AS 'darbuotojai projekte', projektai.projectID, projektai.projectName 
            FROM projektai 
            LEFT JOIN darbuotojai ON darbuotojai.projectID = projektai.projectID
            GROUP BY projectID, projectName";
    
    $result = mysqli_query($conn, $sql);

    // projektu atvaizdavimas
    if (mysqli_num_rows($result) > 0) {
        ?>
        <?php
   
    if (mysqli_num_rows($result) > 0) {
       
        print('<table id="table">');
        print('<thead>');
        print('<tr><th>Id</th><th>Pavadinimas</th><th>Darbuotojai</th>');
        print('</thead><tbody>');
        while($row = mysqli_fetch_assoc($result)) {
        print('<tr><td>' . $row["projectID"] . '</td><td>' . $row["projectName"]. '</td><td>' . $row["darbuotojai projekte"]. '</td></tr>');
        }
        print('</tbody></table>');

    } else {
        echo "0 results";
    }
?>
        <!-- irasyti naują projektą-->
        <div class="container">
        <p>Pridėti projektą:</p>
            
        <form class="form-inline m-2" action="createProject.php" method="POST">
                <label for="projektas">Projekto pavadinimas:</label>
                <input type="text" class="form-control m-2" id="projektas" name="projektas">
                <button type="submit" class="btn btn-primary">Pridėti</button>
        </form>
    </div>

        <?php
    } else {
        echo "0 results";
    }
} else {
    echo("<h2>PASIRINKITE KĄ NORITE MATYTI</h2>");

}

mysqli_close($conn);

?>
<div class="footer">
  <p><a href="https://github.com/justasga">Projekto kodas</a></p>
</div>
</body>
</html>