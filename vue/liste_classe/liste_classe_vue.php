<?php

class liste_classe_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/liste_classe/liste_classe.html");
        $this->file = $file;
    }

    public function replace_classe(array $res)
    {
        $tbody = "";

        foreach ($res as $ligne) //créer le tableau des classes
        { 

            $tbody = $tbody . "<tr>"; //début de la ligne

            foreach ($ligne as $colonne) {

                $tbody = $tbody . "<td>" . $colonne . "</td>";
            }

            $tbody = $tbody .
            '<td>
                <form method="post" action="?page=detail_classe">
                    <input type="submit" value="Voir">
                    <input type="hidden" name="name_classe" value="%name%">
                </form>
            </td>
            
            <td>
                <form method="post" action="?page=supprimer_classe">
                    <input type="submit" value="Supprimer">
                    <input type="hidden" name="name_classe" value="%name%">
                </form>
            </td>
            ';

            $tbody = str_replace("%name%", $ligne[0], $tbody);//rajoute le nom de la classe pour la bouton voir

            $tbody = $tbody . "</tr>"; //fin de la ligne
        }

        $this->file = str_replace("%classe%", $tbody, $this->file);
    }
}

?>