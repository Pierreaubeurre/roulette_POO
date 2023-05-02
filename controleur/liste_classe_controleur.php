<?php
include_once("modele/table/eleveDB.php");


include_once("vue/liste_classe/liste_classe_vue.php");

class liste_classe_controleur
{
    private $table_eleve; //objet du modele eleve
    private $page; //objet de la vue

    function __construct()
    {
        $this->table_eleve = new eleveDB();
        
        $this->page = new liste_classe_vue();

    }

    public function classe()
    {
        $res = $this->table_eleve->selectClassAndCountEleve();

        $this->page->replace_classe($res);

    }

    public function afficher()
    {
        echo ($this->page->file);
    }

}

?>