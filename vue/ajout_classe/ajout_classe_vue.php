<?php

class ajout_classe_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/ajout_classe/ajout_classe.html");
        $this->file = $file;
    }
}

?>