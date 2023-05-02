<?php

class ajout_eleve_vue
{
    // déclaration des propriétés
    public string $file; //contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file = file_get_contents("vue/ajout_eleve/ajout_eleve.html");
        $this->file = $file;
    }

    function replace_classe(string $classe)
    {
        $this->file = str_replace("%classe%", $classe, $this->file);
    }
}

?>