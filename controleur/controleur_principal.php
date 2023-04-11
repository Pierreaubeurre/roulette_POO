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

            default: //Première page, celle du menu
                $this->menu();
                break;

            case "liste_evaluation": //Page affichant la liste des évaluations
                $this->liste_evaluation();
                break;

            case "visualisation_eval": //Page affichant les détails de l'évaluation (élève,note...)
                $this->detail_evaluation();
                break;

            case "selection": //Celle pour voir les détails de l'évaluation crée
                $this->selection();
                break;

            case "evaluation": //Celle pour noter
                $this->evaluation_crée();
                break;

            case "a_noter": //Lorsqu'un élève doit être noter
                $this->a_noter();
                break;
        }
    }

    private function menu()
    {
        require_once("controleur/menu_controleur.php");
        $menu = new menu_controleur();

        $menu->afficher();
    }

    //Partie administration
    private function liste_evaluation()
    {
        require_once("controleur/liste_evaluation_controleur.php");
        $liste_evaluation = new liste_evaluation_controleur();

        $liste_evaluation->evaluations();

        $liste_evaluation->afficher();
    }

    private function detail_evaluation()
    {
        require_once("controleur/detail_evaluation_controleur.php");
        $detail_evaluation = new detail_evaluation_controleur;

        $detail_evaluation->detail();

        $detail_evaluation->afficher();

    }

    //Partie evaluation

    private function selection()
    {
        require_once("controleur/selection_controleur.php");
        $selection = new selection_controleur();
        echo ($selection->vue);
    }

    private function evaluation_crée()
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

    private function a_noter()
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