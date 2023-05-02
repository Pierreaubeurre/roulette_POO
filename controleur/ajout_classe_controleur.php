<?php
include_once("vue/ajout_classe/ajout_classe_vue.php");

class ajout_classe_controleur
{
    private $page; //objet de la vue

    function __construct()
    {
        $this->page = new ajout_classe_vue();
    }

    public function afficher()
    {
        echo ($this->page->file);
    }

}

?>