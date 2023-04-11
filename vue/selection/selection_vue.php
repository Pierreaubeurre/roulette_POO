<?php

class selection_vue
{
    // déclaration des propriétés
    public string $file;//contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file=file_get_contents("vue/selection/selection.html");
        $this->file=$file;

    }

    function replace_classe(array $data)
    {
        $html_liste="";

        foreach ($data as $ligne){
            $html_liste=$html_liste."<option value=".$ligne.">".$ligne."</option>";
        }
    
        $this->file=(str_replace("%select%",$html_liste,$this->file));
    } 
}

?>