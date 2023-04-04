<?php
include_once("modele/connexion.php");

class note
{
    // déclaration des propriétés
    public bool $absence;
    public int $resultat_Note;
    public int $idNote;
    public int $idEleve;
    public int $idEvaluation;

    
    // déclaration du contructeur
    function __construct(bool $nom_Eleve,int $resultat_Note,int $idNote,int $idEleve,int $idEvaluation)
    {
        $this->absence = $nom_Eleve;
        $this->resultat_Note = $resultat_Note;
        $this->idNote = $idNote;
        $this->idEleve = $idEleve;
        $this->idEvaluation=$idEvaluation;
    }

    // déclaration des méthodes
    function delete()
    {
        $conn = new connection();

        $sth = $conn->prepare('DELETE FROM Note WHERE idNote=?;');
        $sth->bind_param('i', $this->idNote);
        $sth->execute();
    }

    function updateResultat(int $resultat)
    {
        $conn = new connection();

        $sth = $conn->prepare('UPDATE Note SET resultat_Note = ? WHERE idNote=?');
        $sth->bind_param('si', $resultat, $this->idEleve);
        $sth->execute();

        $this->resultat_Note = $resultat;
    }
}