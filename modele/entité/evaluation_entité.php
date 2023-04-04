<?php
include_once("modele/connexion.php");

/*

Classe utilisés pour représenter les entités présentes dans la table evaluation
La classe représente la structure de l'entité
Un objet représente une entité présente dans la table
Les methodes permettent de réaliser des changements sur cette seule entité

*/

class evaluation
{
    // déclaration des propriétés
    public string $date_Evaluation;
    public string $nom_Evaluation;
    public int $idEvaluation; //clé primaire

    // déclaration du constructeur
    function __construct(string $date_Evaluation,string $nom_Evaluation, int $idEvaluation)
    {
        $this->date_Evaluation = $date_Evaluation;
        $this->nom_Evaluation = $nom_Evaluation;
        $this->idEvaluation = $idEvaluation;
    }

    function delete()
    {
        $conn = new connection();

        $sth = $conn->prepare('DELETE FROM Evaluation WHERE idEvaluation=?;');
        $sth->bind_param('i', $this->idEvaluation);
        $sth->execute();
    }

    function updateDate($date)
    {
        $conn = new connection();

        $sth = $conn->prepare('UPDATE Evaluation SET date_Evaluation = ? WHERE idEvaluation=?');
        $sth->bind_param('si', $date, $this->idEvaluation);
        $sth->execute();

        $this->date_Evaluation = $date;
    }

    function updateNom($nom)
    {
        $conn = new connection();
        
        $sth = $conn->prepare('UPDATE Evaluation SET nom_Evaluation = ? WHERE idEvaluation=?');
        $sth->bind_param('si', $nom, $this->idEvaluation);
        $sth->execute();

        $this->nom_Evaluation = $nom;
    }

}

?>