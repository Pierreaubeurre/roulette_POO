<?php
include_once("modele/table/evaluationDB.php");
include_once("modele/table/eleveDB.php");


include_once("vue/evaluation/evaluation_vue.php");

class evaluation_controleur
{
    private $table_evaluation; //objet du modele evaluation
    private $table_eleve; //objet du modele eleve

    private $page; //objet de la vue

    function __construct()
    {
        $this->table_evaluation = new evaluationDB();
        $this->table_eleve = new eleveDB();

        $this->page = new evaluation_vue();

    }

    public function créer_evaluation()
    {
        $nom = $_POST["nom_evaluation"];

        $this->table_evaluation->createEvaluation($nom);

        //return boolean pour savoir si c'est bon
    }

    public function id_evaluation()
    {
        $id=$this->table_evaluation->selectLastIdEvaluation();
        $_SESSION["id_evaluation"] = $id;
    }

    public function nom_evaluation()
    {

        $nom = $_POST["nom_evaluation"];
        $_SESSION["nom_evaluation"] = $nom;

        $this->page->replace_name($nom);

    }

    public function date()
    {

        date_default_timezone_set('Europe/Paris');
        $date = date('d/m/y');

        $this->page->replace_date($date);

    }

    public function nom_classe()
    {

        $classe = $_POST["classe"];
        $_SESSION["classe"] = $_POST["classe"];

        $this->page->replace_class($classe);

    }

    public function eleve_classe()
    {
        $classe = $_POST["classe"];
        $res = $this->table_eleve->selectEleveByClass($classe);

        $this->page->replace_eleve_classe($res);

    }

    function afficher()
    {
        echo ($this->page->file);
    }

}

?>