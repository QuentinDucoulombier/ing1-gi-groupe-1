<?php

class router
{

    public static function set_page(): bool
    {
        $pages = $_GET["page"];

        if (is_file("pages/".$pages.".php")){
            include "pages/".$pages.".php";
            return true;
        }
        else {
            include "pages/404.php";
            return false;
        }
    }

    public static function get_page(): string{
        $pages_url = $_GET["page"];

        $result = "404";

        if (is_file("pages/".$pages_url.".php")){
            $result = $pages_url;
        }

        return $result;
    }

}