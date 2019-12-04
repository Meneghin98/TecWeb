<?php
require_once(".\php\connessione.php");

$index = file_get_contents("html/index.html");

$db = connect_db("localhost", "root", "", "decryptedgames");
$query = "SELECT A.path as path, A.title as title, A.category_title as c_title, C.names as category, I.src as img_src, I.alt as img_alt, A.description as description
FROM Articles A join Categories C on A.category=C.id left join images I on I.article=A.id";
$result = mysqli_query($db, $query);
$page = "";
if (!$result) { 
    echo "Errore della query: " . mysqli_error($db) . "."; 
    exit();
}
else{ 
    if(mysqli_num_rows($result) > 0) { 
        $articoli = "";
        while($row = mysqli_fetch_assoc($result)){ 
            $articoli .= "<li><span class=\"" . $row['category'] . "\">" . $row['c_title'] . "</span><a href=\"" . $row['path'] . "\"><img src=\"" 
            . $row['img_src'] . "\" alt=\"" . $row['img_alt'] . "\"/><span class=\"articleListTitle\">" . $row['title'] . "</span></a><p class=\"articleListDesc\">" . $row['description']. "</p></li>";
        }
        mysqli_free_result($result);
    }
} 
mysqli_close($db);

echo str_replace("£Articoli", $articoli, $index);

?>