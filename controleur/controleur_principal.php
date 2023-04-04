<?php
class principal
{
    function __construct()
    {
        session_start();
        session_set_cookie_params(
            ['samesite' => 'lax']);
        

        $page = $_POST["page"];

        switch ($page) {

            default: //Première page, celle de selection de la classe
                $this->selection();
                break;

            case "evaluation": //Seconde page, celle pour noter
                $this->evaluation();
                break;

            case "a_noter": //Lorsqu'un élève doit être noter
                $this->a_noter();
                break;
        }
    }

    function selection()
    {
        require_once("controleur/selection_controleur.php");
        $selection = new selection_controleur();
        echo ($selection->vue);
    }

    function evaluation()
    {
        require_once("controleur/evaluation_controleur.php");
        $evaluation = new evaluation_controleur();

        $evaluation->créer_evaluation();
        $evaluation->nom_evaluation();
        $evaluation->id_evaluation();
        $evaluation->date();
        $evaluation->nom_classe();
        $evaluation->eleve_classe();

        $evaluation->afficher();
    }

    function a_noter()
    {
        require_once("controleur/a_noter_controleur.php");
        $a_noter = new a_noter_controleur();

        $a_noter->evaluer();
        $a_noter->nom_evaluation();
        $a_noter->date();
        $a_noter->nom_classe();
        $a_noter->tirage();
        $a_noter->eleve_noté();
        $a_noter->eleve_pas_noté();

        $a_noter->afficher();
    }
}


?>