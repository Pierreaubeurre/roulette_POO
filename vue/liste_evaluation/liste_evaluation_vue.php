<?php

class liste_evaluation_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/liste_evaluation/liste_evaluation.html");
        $this->file = $file;
    }

    public function replace_evaluations($res)
    { {
            $tbody = "";

            foreach ($res as $ligne) { //créer le tableau des evaluations

                $tbody = $tbody . "<tr>";//début de la ligne

                foreach ($ligne as $colonne) {

                    $tbody = $tbody . "<td>" . $colonne . "</td>";
                }

                $tbody = $tbody .
                    '<td>
                        <form method="post" action="?page=detail_eval">
                            <input type="submit" value="Voir">
                            <input type="hidden" name="id_evaluation" value="%id%">
                        </form>
                    </td>
                    ';

                    $tbody = str_replace("%id%", $colonne, $tbody);//rajoute l'id de l'évaluation

                    $tbody = $tbody . "</tr>";//fin de la ligne
            }

            $this->file = str_replace("%evaluation%", $tbody, $this->file);
        }
    }
}

?>