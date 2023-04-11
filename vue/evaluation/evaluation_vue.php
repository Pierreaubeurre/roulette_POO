<?php
class evaluation_vue
{
    // déclaration des propriétés
    public string $file;//contient le fichier html au fur et à mesure des modifications

    // déclaration du constructeur
    function __construct()
    {
        $file=file_get_contents("vue/evaluation/evaluation.html");
        $this->file=$file;

    }

    public function replace_name($name)
    {
        $this->file=str_replace("%nom_eval%",$name,$this->file);
    }

    public function replace_date($date)
    {
        $this->file=str_replace("%date%",$date,$this->file);
    }

    public function replace_class($classe)
    {
        $this->file=str_replace("%classe%",$classe,$this->file);
    }

    public function replace_eleve_classe($res)
    {
    $tbody = "";

    foreach ($res as $ligne) {//créer le tableau des élèves

        $tbody = $tbody . "<tr>";

        foreach ($ligne as $colonne) {

            $tbody = $tbody . "<td>" . $colonne . "</td>";
        }

        $tbody = $tbody . "</tr>";
    }
    
    $this->file=str_replace("%eleve%",$tbody,$this->file);

    }    
}

?>