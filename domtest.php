<?php 
function DOMinnerHTML(DOMNode $element) 
{ 
    $innerHTML = ""; 
    $children  = $element->childNodes;

    foreach ($children as $child) 
    { 
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML; 
} 
?> 


<?php 
$dom= new DOMDocument(); 
$dom->preserveWhiteSpace = false;
$dom->formatOutput       = true;
$dom->load($html_string); 

$domTable = $dom->getElementsByTagName("table"); 

foreach ($domTable as $tables) 
{ 
    echo DOMinnerHTML($tables); 
} 
?> 