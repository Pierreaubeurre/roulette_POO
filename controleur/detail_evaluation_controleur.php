<?php
include_once("modele/table/noteDB.php");


include_once("vue/detail_evaluation/detail_evaluation_vue.php");

class detail_evaluation_controleur
{
    private $table_note; //objet du modele evaluation
    private $page; //objet de la vue

    function __construct()
    {

        $this->table_note = new noteDB();
        
        $this->page = new detail_evaluation_vue();

    }

    public function detail()
    {
        $id = $_POST["id_evaluation"];
        $res = $this->table_note->selectNoteAndEleveFromidEvaluation($id);

        $this->page->replace_detail($res);

    }

    public function afficher()
    {
        echo ($this->page->file);
    }

}

?>