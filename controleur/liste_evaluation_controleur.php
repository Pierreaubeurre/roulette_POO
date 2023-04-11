<?php
include_once("modele/table/evaluationDB.php");


include_once("vue/liste_evaluation/liste_evaluation_vue.php");

class liste_evaluation_controleur
{
    private $table_evaluation; //objet du modele evaluation
    private $page; //objet de la vue

    function __construct()
    {
        $this->table_evaluation = new evaluationDB();
        
        $this->page = new liste_evaluation_vue();

    }

    public function evaluations(){

        $res=$this->table_evaluation->selectAll();

        $this->page->replace_evaluations($res);
    }

    public function afficher()
    {

        echo ($this->page->file);

    }

}

?>