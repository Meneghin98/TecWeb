<?php

class html
{
    public static function header()
    {
        //bisogna implementare il passaggio da utente registrato a non
        return file_get_contents("../html/header.html");
    }

    public static function menu($current_link)
    {
        $menu = file_get_contents('../html/menu.html');
        switch ($current_link) {
            case "home":
                $menu = str_replace('£curr_home', 'id="currentlink"', $menu);
                $menu = str_replace('£a_home', '', $menu);
                $menu = str_replace('£a_close_home', '', $menu);

                $menu = str_replace('£curr_news', '', $menu);
                $menu = str_replace('£a_news', '<a href="news.php">', $menu);
                $menu = str_replace('£a_close_news', '</a>', $menu);

                $menu = str_replace('£curr_rec', '', $menu);
                $menu = str_replace('£a_rec', '<a href="recensioni.php">', $menu);
                $menu = str_replace('£a_close_rec', '</a>', $menu);

                $menu = str_replace('£curr_altro', '', $menu);
                $menu = str_replace('£a_altro', '<a href="altro.php">', $menu);
                $menu = str_replace('£a_close_altro', '</a>', $menu);
                break;
            case "news":
                $menu = str_replace('£curr_home', '', $menu);
                $menu = str_replace('£a_home', '<a href="../index.php">', $menu);
                $menu = str_replace('£a_close_home', '</a>', $menu);

                $menu = str_replace('£curr_news', 'id="currentlink"', $menu);
                $menu = str_replace('£a_news', '', $menu);
                $menu = str_replace('£a_close_news', '', $menu);

                $menu = str_replace('£curr_rec', '', $menu);
                $menu = str_replace('£a_rec', '<a href="recensioni.php">', $menu);
                $menu = str_replace('£a_close_rec', '</a>', $menu);

                $menu = str_replace('£curr_altro', '', $menu);
                $menu = str_replace('£a_altro', '<a href="altro.php">', $menu);
                $menu = str_replace('£a_close_altro', '</a>', $menu);
                break;
            case "rec":
                $menu = str_replace('£curr_home', '', $menu);
                $menu = str_replace('£a_home', '<a href="../index.php">', $menu);
                $menu = str_replace('£a_close_home', '</a>', $menu);

                $menu = str_replace('£curr_news', '', $menu);
                $menu = str_replace('£a_news', '<a href="news.php">', $menu);
                $menu = str_replace('£a_close_news', '</a>', $menu);

                $menu = str_replace('£curr_rec', 'id="currentlink"', $menu);
                $menu = str_replace('£a_rec', '', $menu);
                $menu = str_replace('£a_close_rec', '', $menu);

                $menu = str_replace('£curr_altro', '', $menu);
                $menu = str_replace('£a_altro', '<a href="altro.php">', $menu);
                $menu = str_replace('£a_close_altro', '</a>', $menu);
                break;
            case "altro":
                $menu = str_replace('£curr_home', '', $menu);
                $menu = str_replace('£a_home', '<a href="../index.php">', $menu);
                $menu = str_replace('£a_close_home', '</a>', $menu);

                $menu = str_replace('£curr_news', '', $menu);
                $menu = str_replace('£a_news', '<a href="news.php">', $menu);
                $menu = str_replace('£a_close_news', '</a>', $menu);

                $menu = str_replace('£curr_rec', '', $menu);
                $menu = str_replace('£a_rec', '<a href="recensioni.php">', $menu);
                $menu = str_replace('£a_close_rec', '</a>', $menu);

                $menu = str_replace('£curr_altro', 'id="currentlink"', $menu);
                $menu = str_replace('£a_altro', '', $menu);
                $menu = str_replace('£a_close_altro', '', $menu);
                break;
        }
        return $menu;
    }

    public static function footer()
    {
        return file_get_contents("../html/footer.html");
    }
}

?>