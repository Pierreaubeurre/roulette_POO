<?php
include_once("modele/table/noteDB.php");
include_once("modele/table/eleveDB.php");


include_once("vue/menu/menu_vue.php");

class menu_controleur
{
    private $page; //objet de la vue

    function __construct()
    {
        
        $this->page = new menu_vue();

    }

    public function afficher()
    {

        echo ($this->page->file);

    }

}

?>