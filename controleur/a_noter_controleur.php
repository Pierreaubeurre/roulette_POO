<?php
include_once("modele/table/noteDB.php");
include_once("modele/table/eleveDB.php");


include_once("vue/page/a_noter/a_noter_page.php");

class a_noter_controleur
{
    private $table_note; //objet du modele evaluation
    private $table_eleve; //objet du modele eleve

    private $page; //objet de la vue

    function __construct()
    {
        $this->table_note = new noteDB();
        $this->table_eleve = new eleveDB();

        $this->page = new evaluation_page();

    }

    public function evaluer()
    {
        if (isset($_POST["note"]) or ($_POST["presence"]=="absent")){

            $this->table_note->createNote();
        }
    }

    public function nom_evaluation()
    {

        $nom = $_SESSION["nom_evaluation"];

        $this->page->replace_name($nom);

    }

    public function date() //met la date du jour au html envoyer à l'utilisateur
    {

        date_default_timezone_set('Europe/Paris');
        $date = date('d/m/y');

        $this->page->replace_date($date);

    }

    public function nom_classe()
    {

        $classe = $_SESSION["classe"];

        $this->page->replace_class($classe);

    }

    public function tirage()
    {
        
        $classe = $_SESSION["classe"];
        $idEvaluation = $_SESSION["id"];

        $table=$this->table_eleve->selectEleveNonNoté($classe,$idEvaluation);

        $nombre_eleve = sizeof($table);
        $aléatoire = rand(1,$nombre_eleve);
        $eleve = $table[$aléatoire];

        
        $nom=$eleve->nom_Eleve;
        $prenom=$eleve->prenom_Eleve;
        $idEleve=$eleve->idEleve;

        $this->page->replace_tirage($nom,$prenom,$idEleve);
    }

    public function eleve_noté()
    {
        $idEvaluation = $_SESSION["id"];
        $classe = $_SESSION["classe"];
 
        $res=$this->table_eleve->selectEleveNoté($idEvaluation,$classe);


        $this->page->replace_noté($res);

    }

    public function eleve_pas_noté()
    {
        $classe = $_SESSION["classe"];
        $idEvaluation = $_SESSION["id"];


        $eleve=$this->table_eleve->selectEleveNonNoté($classe,$idEvaluation);

        $this->page->replace_non_noté($eleve);
    }

    public function afficher()
    {

        echo ($this->page->file);

    }

}

?>