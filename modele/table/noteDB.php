<?php

include_once("../connexion.php");
include_once("../entité/note_entité.php");

class noteDB
{
    // déclaration des propriétés
    public $conn;
    public array $resultat;

    // déclaration du constructeur
    function __construct()
    {
        $this->conn = new connection(); //Met l'objet de connexion dans le parametre
    }


    // déclaration des méthodes
    public function create(int $presence, int $resultat, int $idEleve, int $idEvaluation)
    {

        $sth = $this->conn->prepare('INSERT INTO Note (absence,resultat_Note,idEleve,idEvaluation) VALUES (?,?,?,?)');
        $sth->bind_param('iiii', $presence, $resultat, $idEleve, $idEvaluation);
        $sth->execute();
    }
    public function createNote()
    {

        $idEvaluation = $_SESSION["id_evaluation"];
        $idEleve = $_POST["id_eleve"];
        $presence = $_POST["presence"];
        
    
        $req = "SELECT * FROM Note WHERE idEvaluation = $idEvaluation AND idEleve=$idEleve";
        $res = $this->conn->query($req);
    
    
        if ($res->num_rows==0){//vérifie si l'élève n'a pas déjà été noté
    
            if ($presence=="present"){//vérifie si l'élève est présent
                $presence = 1;
                $note = $_POST["note"];
        
                $req = "INSERT INTO Note (resultat_Note, absence, idEleve ,idEvaluation) values ($note,$presence,$idEleve,$idEvaluation);";
    
            }
            else{//vérifie si l'élève est absent
                $presence = 0;
                $req = "INSERT INTO Note (absence, idEleve ,idEvaluation) values ($presence,$idEleve,$idEvaluation);";
            }
        
            $this->conn->query($req);
        }
    }

    public function selectById(int $idNote)
    {

        $sth = $this->conn->prepare('SELECT * FROM Note WHERE idNote = ?');
        $sth->bind_param('i', $idNote);
        $sth->execute();


        return $this->note($sth);
    }

    public function selectByIdEleve(int $idEleve)
    {

        $sth = $this->conn->prepare('SELECT * FROM Note WHERE idEleve = ?');
        $sth->bind_param('i', $idEleve);
        $sth->execute();


        return $this->note($sth);
    }

    //méthode pour choisir une/des evaluation grâce à un nom
    public function selectByIdEvaluation(int $idEvaluation)
    {

        $sth = $this->conn->prepare('SELECT * FROM Note WHERE idEvaluation = ?');
        $sth->bind_param('i', $idEvaluation);
        $sth->execute();


        return $this->note($sth);
    }

    public function selectByFirstname(string $firstname)
    {

        $sth = $this->conn->prepare('SELECT * FROM Eleve WHERE prenom_Eleve = ?');
        $sth->bind_param('s', $firstname);
        $sth->execute();


        return $this->note($sth);
    }

    private function note($sth)
    {
        $result_sql = $sth->get_result();

        $resultat = array();

        foreach ($result_sql as $value) {

            $evaluation = new eleve($value["nom_Eleve"], $value["prenom_Eleve"], $value["classe"], $value["idEleve"]);

            array_push($resultat, $evaluation);

        }

        return $resultat;
    }
}

?>