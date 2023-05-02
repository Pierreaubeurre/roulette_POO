<?php

class detail_classe_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/detail_classe/detail_classe.html");
        $this->file = $file;
    }

    public function replace_detail($res)
    {
        $tbody = "";

        foreach ($res as $ligne) //créer le tableau des élèves
        { 

            $tbody = $tbody . "<tr>"; //début de la ligne

            foreach ($ligne as $colonne) {

                $tbody = $tbody . "<td>" . $colonne . "</td>";
            }


            $tbody = $tbody .
            '
            <td>
                <form method="post" action="?page=supprimer_eleve">
                    <input type="submit" value="Supprimer">
                    <input type="hidden" name="id_Eleve" value=%id%>
                </form>
            </td>
            ';

            $tbody = str_replace("%id%", $colonne, $tbody);//rajoute le nom de la classe pour la bouton voir


            $tbody = $tbody . "</tr>"; //fin de la ligne
        }

        $this->file = str_replace("%detail%", $tbody, $this->file);
    }
}

?>