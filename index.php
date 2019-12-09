<?php
require_once('php\connessione.php');
require_once('php\replace.php');

$index = file_get_contents("html/index.html");

$db = connect_db("localhost", "root", "", "decryptedgames");
$query = "SELECT A.creation_date as data, A.path as path, A.title as title, A.category_title as c_title, C.names as category, I.src as img_src, I.alt as img_alt, A.description as description
FROM Articles A join Categories C on A.category=C.id left join images I on I.article=A.id
ORDER BY data DESC";
$result = mysqli_query($db, $query);
$page = "";
if (!$result) { 
    echo "Errore della query: " . mysqli_error($db) . "."; 
    exit();
}
else{ 
    if(mysqli_num_rows($result) > 0) { 
        $top_articoli = "";
        for ($i = 0; $i < 4; $i++){
            $row = mysqli_fetch_assoc($result);
            $top_articoli .= '<li><a href="'. $row['path'] .'"><img src="' . $row['img_src'] . '" alt="'. $row['img_alt'] . '"/><span class="topArticleTitle">'
                . $row['title'] ."</span></a>></li>";
        }
        $articoli = "";
        while($row = mysqli_fetch_assoc($result)){ 
            $articoli .= "<li><span class=\"" . $row['category'] . "\">" . $row['c_title'] . "</span><a href=\"" . $row['path'] . "\"><img src=\"" 
            . $row['img_src'] . "\" alt=\"" . $row['img_alt'] . "\"/><span class=\"articleListTitle\">" . $row['title'] . "</span></a><p class=\"articleListDesc\">" . $row['description']. "</p></li>";
        }
        mysqli_free_result($result);
    }
} 
mysqli_close($db);
$index = str_replace('£top_articles', $top_articoli, $index);

echo str_replace("£Articoli", $articoli, $index);