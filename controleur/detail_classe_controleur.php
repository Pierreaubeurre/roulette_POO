<?php
include_once("modele/table/eleveDB.php");


include_once("vue/detail_classe/detail_classe_vue.php");

class detail_classe_controleur
{
    private $table_eleve; //objet du modele eleve
    private $page; //objet de la vue

    function __construct()
    {
        $this->table_eleve = new eleveDB();
        
        $this->page = new detail_classe_vue();
    }

    public function detail()
    {
        if (!isset($_POST["name_classe"]))
        {
            $name=$_SESSION["name_classe"];
        }
        else
        {         
            $name=$_POST["name_classe"];
            $_SESSION["name_classe"]=$name;
        }

        $result = $this->table_eleve->selectEleveByClass($name);

        $this->page->replace_detail($result);

    }

    public function afficher()
    {
        echo ($this->page->file);
    }

}

?>