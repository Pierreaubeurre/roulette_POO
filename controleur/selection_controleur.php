<?php
include_once("modele/table/eleveDB.php");

include_once("vue/page/selection/selection_page.php");

class selection_controleur
{
    public string $vue;

    function __construct()
    {
        $classe_dispo =$this->modele();
        $this->vue($classe_dispo);
    }

    private function modele()
    {
        $modele = new eleveDB();
        $classe = $modele->selectDistinctClass();

        return $classe;
    }

    private function vue($classe_dispo)
    {
        $page = new selection_page();
        $page->replace_classe($classe_dispo);
        $this->vue=$page->file;

    }
    
}

?>