<?php

class detail_evaluation_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/detail_evaluation/detail_evaluation.html");
        $this->file = $file;
    }

    function replace_detail($res)
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

            
            $tbody = $tbody .
            '<td>
            <form method="post">
            <button name="page" value="modification_note">Modifier</button>
            <input type="text" name="id_evaluation" value="%id%" hidden="">
            </form>
            </td>
            ';

            $tbody = $tbody .
            '<td>
            <form method="post">
            <button name="page" value="supprimer_note">Supprimer</button>
            <input type="text" name="id_evaluation" value="%id%" hidden="">
            </form>
            </td>
            ';


            $tbody = str_replace("%id%", $colonne, $tbody);//rajoute l'id de l'évaluation

            $tbody = $tbody . "</tr>"; //fin de la ligne
        }

        $this->file = str_replace("%detail%", $tbody, $this->file);

    }

}

?>