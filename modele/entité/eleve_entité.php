<?php
include_once("modele/connexion.php");

/*

Classe utilisés pour représenter les entités présentes dans la table eleve
La classe représente la structure de l'entité
Un objet représente une entité présente dans la table
Les methodes permettent de réaliser des changements sur cette seule entité

*/

class eleve
{
    // déclaration des propriétés 
    public string $nom_Eleve;
    public string $prenom_Eleve;
    public string $classe;
    public int $idEleve;//clé primaire

    // déclaration du constructeur
    function __construct(string $nom_Eleve,string $prenom_Eleve, string $classe ,int $idEleve)
    {
        $this->nom_Eleve = $nom_Eleve;
        $this->prenom_Eleve = $prenom_Eleve;
        $this->classe = $classe;
        $this->idEleve = $idEleve;
    }

    function delete()
    {
        $conn = new connection();

        $sth = $conn->prepare('DELETE FROM Eleve WHERE idEleve=?;');
        $sth->bind_param('i', $this->idEleve);
        $sth->execute();
    }

    function updateNom(string $nom)
    {
        $conn = new connection();

        $sth = $conn->prepare('UPDATE Eleve SET nom_Eleve = ? WHERE idEleve=?');
        $sth->bind_param('si', $nom, $this->idEleve);
        $sth->execute();

        $this->nom_Eleve = $nom;
    }

    function updatePrenom(string $prenom)
    {
        $conn = new connection();

        $sth = $conn->prepare('UPDATE Eleve SET nom_Eleve = ? WHERE idEleve=?');
        $sth->bind_param('si', $prenom, $this->idEleve);
        $sth->execute();

        $this->prenom_Eleve = $prenom;
    }

    function updateClasse(string $classe)
    {
        $conn = new connection();

        $sth = $conn->prepare('UPDATE Eleve SET classe = ? WHERE idEleve=?');
        $sth->bind_param('si', $classe, $this->idEleve);
        $sth->execute();

        $this->classe = $classe;
    }

}

?>