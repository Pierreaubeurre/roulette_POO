<?php
class a_noter_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/a_noter/a_noter.html");
        $this->file = $file;
    }

    public function replace_name(string $name)
    {
        $this->file = str_replace("%nom_eval%", $name, $this->file);
    }

    public function replace_date(string $date)
    {
        $this->file = str_replace("%date%", $date, $this->file);
    }

    public function replace_class(string $classe)
    {
        $this->file = str_replace("%classe%", $classe, $this->file);
    }

    public function replace_tirage(string $nom, string $prenom, string $idEleve)
    {
        $this->file = str_replace("%nom%", $nom, $this->file);
        $this->file = str_replace("%prenom%", $prenom, $this->file);
        $this->file = str_replace("%id_eleve%", $idEleve, $this->file);
    }

    public function replace_noté(object $res)
    {
        $tbody = "";

        foreach ($res as $ligne) { //créer le tableau des evaluations

            $compteur = 0;


            $tbody = $tbody . "<tr>"; //début de la ligne

            foreach ($ligne as $colonne) {

                if ($compteur == 3) {
                    if ($colonne == 1) {
                        $colonne = "Présent(e)";
                    } else {
                        $colonne = "Absent(e)";
                    }
                }

                $tbody = $tbody . "<td>" . $colonne . "</td>";


                $compteur++;
            }
        }
        
        $this->file = str_replace("%eleve_noté%", $tbody, $this->file);
    }

    public function replace_non_noté($eleve)
    {
        $tbody = "";

        foreach ($eleve as $ligne) { //créer le tableau des élèves

            $tbody = $tbody . "<tr>";

            $tbody = $tbody . "<td>" . $ligne->nom_Eleve . "</td>";
            $tbody = $tbody . "<td>" . $ligne->prenom_Eleve . "</td>";
            $tbody = $tbody . "<td>" . $ligne->idEleve . "</td>";

            $tbody = $tbody . "</tr>";
        }

        $this->file = str_replace("%eleve_pas_noté%", $tbody, $this->file); //rempli le tableau avec les élèves
    }

}

?>