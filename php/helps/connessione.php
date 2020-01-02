<?php

class DBConnection
{
    const HOST = 'localhost';
    const USER = 'user';
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

    //converte la data e l'ora presente nel database (che quindi è in un formato non italiano) nella sequenza hh:mm gg/mm/aaaa
    private function convert_data_ora($data)
    {
        $data = str_replace(':', '', $data);
        $data = str_replace('-', '', $data);
        $data = str_replace(' ', '', $data);
        $anno = substr($data, 0, 4);
        $mese = substr($data, 4, 2);
        $giorno = substr($data, 6, 2);
        $ora = substr($data, 8, 2);
        $minuti = substr($data, 10, 2);
        return "$ora:$minuti $giorno/$mese/$anno";
    }

    public function addLike($nickname, $idCommento)
    {
        $query = "INSERT INTO likes VALUES ('$nickname', '$idCommento')";
        mysqli_query($this->connection, $query);
    }

    public function removeLike($nickname, $idCommento)
    {
        $query = "DELETE FROM likes WHERE likes.nickname = '$nickname' AND likes.id = '$idCommento'";
        mysqli_query($this->connection, $query);
    }

    public function putComment($text, $user, $article)
    {
        $query = "INSERT INTO comments VALUES (NULL, DEFAULT, '$text', '$user', '$article')";
        mysqli_query($this->connection, $query);
    }

    public function newUser($nome,$cognome,$username,$email,$password) {
        $query = "INSERT INTO users VALUES ('$username','$cognome','$email','$nome','$password')";
    }

    public function getLikesOfUser($nickname, $idArticolo)
    {
        $query = "SELECT c.id FROM comments c JOIN likes l ON c.id=l.id WHERE l.nickname='$nickname' AND c.article='$idArticolo'";
        $queryResult = mysqli_query($this->connection, $query);
        $likes = array();
        while ($row = mysqli_fetch_assoc($queryResult)) {
            array_push($likes, $row['id']);
        }
        mysqli_free_result($queryResult);
        return $likes;
    }

    public function getCommentsArrayOfArtile($idArticle)
    {
        $query = "SELECT c.*, COUNT(l.id) as likes FROM comments c LEFT JOIN likes l ON l.id=c.id 
                    WHERE c.article = '$idArticle' GROUP BY c.id";
        $queryResult = mysqli_query($this->connection, $query);
        if (!$queryResult)
            return null;
        if (mysqli_num_rows($queryResult) > 0) {
            $commentArray = array();
            while ($row = mysqli_fetch_assoc($queryResult)) {
                $comment = array(
                    'id' => $row['id'],
                    'data' => $this->convert_data_ora($row['creation_date']),
                    'testo' => $row['txt'],
                    'utente' => $row['user'],
                    'id_articolo' => $row['article'],
                    'likes' => $row['likes']
                );
                array_push($commentArray, $comment);
            }
            mysqli_free_result($queryResult);
            return $commentArray;
        } else return null;
    }

    public function getArticleByID($id)
    {
        $query = "SELECT A.creation_date as data, A.id as id, A.path as path, A.title as title, 
                    A.category_title as c_title, C.names as category, I.src as img_src, I.alt as img_alt, 
                    A.description as description FROM articles A join categories C on A.category=C.id left join images I 
                    on I.article=A.id WHERE A.id = '$id'";
        $result = mysqli_query($this->connection, $query);
        if (is_null($result)) {
            return null;
        }
        $row = mysqli_fetch_assoc($result);
        $articolo = array(
            'ID' => $row['id'],
            'data' => $row['data'],
            'path' => $row['path'],
            'titolo' => $row['title'],
            'descrizione' => $row['description'],
            'titolo_categoria' => $row['c_title'],
            'categoria' => $row['category'],
            'img' => $row['img_src'],
            'alt' => $row['img_alt'],
        );
        mysqli_free_result($result);
        return $articolo;
    }

    public function getArticlesArray($where)
    {
        if (is_null($where))
            $query = "SELECT A.creation_date as data, A.id as id, A.path as path, A.title as title, A.category_title as c_title, 
                C.names as category, I.src as img_src, I.alt as img_alt, A.description as description FROM articles A join 
                categories C on A.category=C.id left join images I on I.article=A.id ORDER BY data DESC";
        else
            $query = "SELECT A.creation_date as data, A.id as id, A.path as path, A.title as title, A.category_title as c_title, 
                C.names as category, I.src as img_src, I.alt as img_alt, A.description as description FROM articles A join 
                categories C on A.category=C.id left join images I on I.article=A.id WHERE A.article_type = '$where' 
                ORDER BY data DESC";
        $queryResult = mysqli_query($this->connection, $query);
        if (!$queryResult) {
            echo "Errore della query: " . mysqli_error($this->connection) . ".";
            exit();
        }
        if (mysqli_num_rows($queryResult) > 0) {
            $articleArray = array();
            while ($row = mysqli_fetch_assoc($queryResult)) {
                $articolo = array(
                    'pathID' => "articolo.php?id=$row[id]",
                    'data' => $row['data'],
                    'path' => $row['path'],
                    'titolo' => $row['title'],
                    'descrizione' => $row['description'],
                    'titolo_categoria' => $row['c_title'],
                    'categoria' => $row['category'],
                    'img' => $row['img_src'],
                    'alt' => $row['img_alt'],
                );
                array_push($articleArray, $articolo);
            }
            mysqli_free_result($queryResult);
            return $articleArray;
        } else
            return null;
    }

    public function getUtenteArray($nickname)
    {
        if (is_null($nickname)) {
            echo "ERRORE: L'utente deve essere specificato";
            exit();
        } else {
            $query = "SELECT * FROM users WHERE users.nickname='$nickname'";
            $queryResult = mysqli_query($this->connection, $query);
            if (!$queryResult) {
                return null;
            }
            if (mysqli_num_rows($queryResult) == 1) {
                $utenteTrovato = mysqli_fetch_assoc($queryResult);
                mysqli_free_result($queryResult);
                return array(
                    'nickname' => $utenteTrovato['nickname'],
                    'password' => $utenteTrovato['pwd'],
                    'email' => $utenteTrovato['email'],
                    'nome' => $utenteTrovato['username'],
                    'cognome' => $utenteTrovato['surname'],
                    'tipologia' => $utenteTrovato['usertype'],
                    'riferimento' => $utenteTrovato['ref'],
                    'img' => $utenteTrovato['img_src']
                );
            } else if (mysqli_num_rows($queryResult) > 1)
                echo "ERRORE: Più utenti con lo stesso nickname";
            else
                echo "ERRORE: Nessun utente trovato"; //implementare redirect
        }
    }
    public function updateUser($nickname, $valuesArray){
        if ($valuesArray['oldPwd'] === "")
            $query = "UPDATE users SET nickname = '$valuesArray[nickname]', email = '$valuesArray[email]', 
                username = '$valuesArray[nome]', surname = '$valuesArray[cognome]', ref = '$valuesArray[riferimento]' 
                WHERE users.nickname = '$nickname'";
        else
            $query = "UPDATE users SET pwd = '$valuesArray[newPwd]', nickname = '$valuesArray[nickname]', 
            email = '$valuesArray[email]', username = '$valuesArray[nome]', surname = '$valuesArray[cognome]', 
            ref = '$valuesArray[riferimento]' WHERE users.nickname = '$nickname'";

        mysqli_query($this->connection, $query);
    }

    function existsNickname($nickname){
        $query = "Select * from users where nickname = '$nickname'";
        $queryResult = mysqli_query($this->connection, $query);
        if ($queryResult)
            return true; //il nickname inserito è già presente
        return false;
    }

    function exitsEmail($email) {
        $query = "Select * from users where email = '$email'";
        $queryResult = mysqli_query($this->connection, $query);
        if ($queryResult)
            return true;
        return false;
    }

    function exitsPassword($password) {
        $query = "Select * from users where email = '$password'";
        $queryResult = mysqli_query($this->connection, $query);
        if ($queryResult)
            return true;
        return false;
    }

    public function close()
    {
        mysqli_close($this->connection);
    }
}
