<?php
include_once("modele/connexion.php");
include_once("modele/entité/evaluation_entité.php");

/*

Classe utilisés pour les requêtes sql sur la table evaluation
La classe représente la table
Un objet représente une connexion à la table
$resultat représente la réponse de la requête demandée

*/

class evaluationDB
{
    // déclaration des propriétés
    private $conn;

    // déclaration du constructeur
    function __construct()
    {
        $this->conn = new connection();//Met l'objet de connexion dans le parametre
    }

    public function createEvaluation($nom,$date)
    {
        
        $sth = $this->conn->prepare('INSERT INTO Evaluation (nom_Evaluation,date_Evaluation) VALUES (?,?)');
        $sth->bind_param('ss', $nom,$date);
        $sth->execute();
    }

    //méthode pour choisir l'id de la dernière évaluation réalisée
    public function selectLastIdEvaluation()
    {

        $req = "SELECT MAX(idEvaluation) FROM Evaluation";
        $res = $this->conn->query($req);
        $res = (mysqli_fetch_array($res)[0]);
    
        
        return $res;

    }

    //méthode pour choisir une evaluation grâce à une id
    public function selectEvaluationById(int $idEvaluation)
    {
        
        $sth = $this->conn->prepare('SELECT * FROM Evaluation WHERE idEvaluation = ?');
        $sth->bind_param('i', $idEvaluation);
        $sth->execute();


        return $this->evaluation($sth);
    }

    //méthode pour choisir une/des evaluation grâce à un nom
    public function selectEvaluationByName(string $nom_Evaluation)
    {
        
        $sth = $this->conn->prepare('SELECT * FROM Evaluation WHERE nom_Evaluation = ?');
        $sth->bind_param('s', $nom_Evaluation);
        $sth->execute();


        return $this->evaluation($sth);
    }

    //méthode pour choisir une/des evaluation grâce à une date
    public function selectEvaluationByDate(string $date_Evaluation)
    {
        
        $sth = $this->conn->prepare('SELECT * FROM Evaluation WHERE date_Evaluation = ?');
        $sth->bind_param('s', $date_Evaluation);
        $sth->execute();


        return $this->evaluation($sth);
    }

    private function evaluation($sth)
    {
        $result_sql = $sth->get_result(); 

        $resultat=array();

        foreach ($result_sql as $value) {

            $evaluation = new evaluation($value["date_Evaluation"],$value["nom_Evaluation"],$value["idEvaluation"]);
            
            array_push($resultat,$evaluation);
            
        }

        return $resultat;
    }

}

?>