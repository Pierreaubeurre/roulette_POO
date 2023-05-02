<?php
class principal
{
    function __construct()
    {
        session_set_cookie_params(
            ['samesite' => 'lax']
        );
        session_start();

        
        if (isset($_GET["page"])) 
        {
            $page = $_GET["page"];
        }
        else
        {
            $page ="";
        }

        switch ($page) {

            default: //Première page, celle du menu
                $this->menu();
                break;

            case "liste_evaluation": //Page affichant la liste des évaluations
                $this->liste_evaluation();
                break;

            case "detail_eval": //Page affichant les détails de l'évaluation (élève,note...)
                $this->detail_evaluation();
                break;

            case "selection": //Celle pour voir les détails de l'évaluation crée
                $this->selection();
                break;

            case "evaluation": //Celle pour noter
                $this->evaluation_créer();
                break;

            case "a_noter": //Lorsqu'un élève doit être noter
                $this->a_noter();
                break;

            case "liste_classe": //Liste des classes
                $this->liste_classe();
                break;

            case "ajout_classe":
                $this->ajout_classe();
                break;

            case "créer_classe":
                $this->créer_classe();
                break;

            case "detail_classe": //Détails de la classe selectionnée
                $this->detail_classe();
                break;

            case "supprimer_classe": //Action de supprimer un élève, renvoie sur detail_classe après
                $this->supprimer_classe();
                break;

            case "ajout_eleve":
                $this->ajout_eleve();
                break;

            case "créer_eleve": //Action de créer un élève, renvoie sur detail_classe après
                $this->créer_eleve();
                break;

            case "supprimer_eleve": //Action de supprimer un élève, renvoie sur detail_classe après
                $this->supprimer_eleve();
                break;
        }
    }

    private function menu()
    {
        require_once("controleur/menu_controleur.php");
        $menu = new menu_controleur();

        $menu->afficher();
    }

    //Partie notation

    private function selection()
    {
        require_once("controleur/selection_controleur.php");
        $selection = new selection_controleur();
        echo ($selection->vue);
    }

    private function evaluation_créer()
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

    //Partie gestion des évaluations
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

    //Partie gestion des classes
    private function liste_classe()
    {
        require_once("controleur/liste_classe_controleur.php");
        $liste_classe = new liste_classe_controleur();

        $liste_classe->classe();

        $liste_classe->afficher();
    }

    private function ajout_classe()
    {
        require_once("controleur/ajout_classe_controleur.php");
        $ajout_classe = new ajout_classe_controleur();

        $ajout_classe->afficher();
    }

    private function detail_classe()
    {
        require_once("controleur/detail_classe_controleur.php");
        $detail_classe = new detail_classe_controleur();

        $detail_classe->detail();

        $detail_classe->afficher();
    }

    private function ajout_eleve()
    {
        require_once("controleur/ajout_eleve_controleur.php");
        $ajout_eleve = new ajout_eleve_controleur();

        $ajout_eleve->classe();

        $ajout_eleve->afficher();
    }

    //méthode des actions

    private function supprimer_classe()
    {
        require_once("modele/table/eleveDB.php");
        $modele = new eleveDB();

        $classe = $_POST["name_classe"];

        $modele->deleteClass($classe);

        $this->liste_classe();
    }

    private function créer_classe()
    {
        require_once("modele/table/eleveDB.php");
        $modele = new eleveDB();

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $classe = $_POST["name_classe"];

        $modele->createEleve($nom, $prenom, $classe);

        $this->liste_classe();
    }

    private function créer_eleve()
    {
        require_once("modele/table/eleveDB.php");
        $modele = new eleveDB();

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $classe = $_SESSION["name_classe"];

        $modele->createEleve($nom, $prenom, $classe);

        $this->detail_classe();
    }

    private function supprimer_eleve()
    {
        require_once("modele/table/eleveDB.php");
        $modele = new eleveDB();

        $id = $_POST["id_Eleve"];

        $modele->deleteEleve($id);


        $this->detail_classe();
    }

}

?>