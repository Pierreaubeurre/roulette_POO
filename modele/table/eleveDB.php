<?php
include_once("modele/connexion.php");
include_once("modele/entité/eleve_entité.php");

class eleveDB
{
    // déclaration des propriétés
    private $conn;

    // déclaration du constructeur
    function __construct()
    {
        $this->conn = new connection(); //Met l'objet de connexion dans le parametre
    }

    //méthode pour créer un élève
    public function createEleve(string $nom, string $prenom, string $classe)
    {
        $sth = $this->conn->prepare('INSERT INTO Eleve (nom_Eleve,prenom_Eleve,classe) VALUES (?,?,?)');
        $sth->bind_param('sss', $nom, $prenom, $classe);
        $sth->execute();
    }

    //Méthode pour selectionner les différentes classes présente dans le tableau
    public function selectDistinctClass()
    {
        $classe = array();

        $req = "SELECT DISTINCT classe FROM Eleve";

        $res = $this->conn->query($req);

        while ($result = $res->fetch_row()) { // extrait chaque ligne une à une
            array_push($classe, $result[0]);
        }


        return $classe;
    }

    //Méthode pour supprimer une classe
    public function deleteClass(string $classe)
    {
        $sth = $this->conn->prepare('DELETE FROM Eleve WHERE classe = ?');
        $sth->bind_param('s', $classe);
        $sth->execute();
    }

    //méthode pour choisir une/des eleve grâce à une classe
    public function selectEleveByClass(string $classe)
    {
        $sth = $this->conn->prepare('SELECT nom_Eleve,prenom_Eleve,idEleve FROM Eleve WHERE classe = ?');
        $sth->bind_param('s', $classe);
        $sth->execute();

        $result = $sth->get_result();


        return $result;
    }
    
    //méthode pour choisir une/des eleves non notés
    public function selectEleveNonNoté(string $classe, int $idEvaluation)
    {
        $sth = $this->conn->prepare('SELECT * from Eleve WHERE classe = ? AND idEleve NOT IN (SELECT idEleve FROM Note WHERE idEvaluation = ? )');
        $sth->bind_param('si', $classe, $idEvaluation);
        $sth->execute();

        return $this->eleve($sth);
    }

    //méthode pour choisir une/des eleves notés
    public function selectEleveNoté(int $idEvaluation, string $classe)
    {
        $sth = $this->conn->prepare('SELECT nom_Eleve,prenom_Eleve,Eleve.idEleve,absence,resultat_Note FROM Eleve,Note WHERE idEvaluation= ? AND Note.idEleve=Eleve.idEleve AND Classe= ? ');
        $sth->bind_param('is', $idEvaluation, $classe);
        $sth->execute();

        $result = $sth->get_result();

        return $result;
    }

    //méthode pour une classe et son nombre d'élève
    public function selectClassAndCountEleve()
    {
        $classe = array();

        $req = "SELECT classe,COUNT(*) FROM Eleve GROUP BY classe";

        $res = $this->conn->query($req);

        while ($result = $res->fetch_row()) { // extrait chaque ligne une à une
            array_push($classe, $result);
        }

        return $classe;
    }

    //méthode pour supprimer un élève grâce à son id
    public function deleteEleve(int $idEleve)
    {
        $sth = $this->conn->prepare("DELETE FROM Eleve WHERE idEleve = ?");
        $sth->bind_param('i', $idEleve);
        $sth->execute();
    }

    private function eleve($sth)
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