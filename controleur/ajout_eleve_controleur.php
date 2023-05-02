<?php
include_once("vue/ajout_eleve/ajout_eleve_vue.php");

class ajout_eleve_controleur
{
    private $page; //objet de la vue

    function __construct()
    {
        $this->page = new ajout_eleve_vue();
    }

    function classe()
    {
        $classe=$_SESSION["name_classe"];

        $this->page->replace_classe($classe);        
    }

    public function afficher()
    {
        echo ($this->page->file);
    }

}

?>