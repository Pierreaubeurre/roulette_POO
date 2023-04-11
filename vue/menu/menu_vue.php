<?php

class menu_vue
{
    // déclaration des propriétés
    public string $file;//contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file=file_get_contents("vue/menu/menu.html");
        $this->file=$file;
    }
}

?>