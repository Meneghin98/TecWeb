<?php

class DBConnection
{
    const HOST = 'localhost';
    const USER = 'root';
    const PWD = '';
    const DB = 'DecryptedGames';

    public $connection = null;

    function __construct()
    {
        $this->connection = $this->connect_db();
    }

    private function connect_db()
    {
        $connessione = new mysqli(self::HOST, self::USER, self::PWD, self::DB);

        if (mysqli_connect_errno()) {
            echo "Connessione fallita (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }
        return $connessione;
    }

    public function putComment($text, $user){
        $query = "INSERT INTO comments VALUES (NULL, DEFAULT, '$text', '$user', 1)";
        mysqli_query($this->connection, $query);
    }

    public function getArticlesArray($where)
    {
        if (is_null($where))
            $query = "SELECT A.creation_date as data, A.path as path, A.title as title, A.category_title as c_title, C.names as category, I.src as img_src, I.alt as img_alt, A.description as description FROM articles A join categories C on A.category=C.id left join images I on I.article=A.id ORDER BY data DESC";
        else
            $query = "SELECT A.creation_date as data, A.path as path, A.title as title, A.category_title as c_title, C.names as category, I.src as img_src, I.alt as img_alt, A.description as description FROM articles A join categories C on A.category=C.id left join images I on I.article=A.id WHERE A.article_type = '$where' ORDER BY data DESC";
        $queryResult = mysqli_query($this->connection, $query);
        if (!$queryResult) {
            echo "Errore della query: " . mysqli_error($this->connection) . ".";
            exit();
        }
        if(mysqli_num_rows($queryResult) > 0) {
            $articleArray = array();
            while ($row = mysqli_fetch_assoc($queryResult)){
                $articolo = array(
                    'data'=>$row['data'],
                    'path'=>$row['path'],
                    'titolo'=>$row['title'],
                    'descrizione'=>$row['description'],
                    'titolo_categoria'=>$row['c_title'],
                    'categoria'=>$row['category'],
                    'img'=>$row['img_src'],
                    'alt'=>$row['img_alt'],
                );
                array_push($articleArray, $articolo);
            }
            mysqli_free_result($queryResult);
            return $articleArray;
        }
        else
            return null;
    }
    public function getUtenteArray($nickname){
        if (is_null($nickname)) {
            echo "ERRORE: L'utente deve essere specificato";
            exit();
        }
        else{
            $query = "SELECT * FROM users WHERE users.nickname='$nickname'";
            $queryResult = mysqli_query($this->connection, $query);
            if (!$queryResult) {
                echo "Errore della query: " . mysqli_error($this->connection) . ".";
                exit();
            }
            if (mysqli_num_rows($queryResult) == 1) {
                $utenteTrovato = mysqli_fetch_assoc($queryResult);
                mysqli_free_result($queryResult);
                return array(
                    'nick'=>$utenteTrovato['nickname'],
                    'password'=>$utenteTrovato['pwd'],
                    'email'=>$utenteTrovato['email'],
                    'nome'=>$utenteTrovato['username'],
                    'cognome'=>$utenteTrovato['surname'],
                    'tipologia'=>$utenteTrovato['usertype'],
                    'riferimento'=>$utenteTrovato['ref']
                );
            }
            else if (mysqli_num_rows($queryResult) > 1)
                echo "ERRORE: Più utenti con lo stesso nickname";
            else
                echo "ERRORE: Nessun utente trovato";
        }
    }

    public function close(){
        mysqli_close($this->connection);
    }
}
