<?php

function bis($string)
{
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) 
    {
        $location = 'Location: ';
        $location = $location . $_SERVER['HTTP_REFERER'] . '?error=posdw';
    } 
    else 
    {
        $location = $location . '../index?error=posdw';
    }

    $sql_szo_lista = array("SELECT", "INSERT", "UPDATE", "DELETE", "FROM", "WHERE", "DROP", "CREATE", "TABLE", "ALTER", "GRANT", "EXECUTE"); 

    foreach ($sql_szo_lista as $sql_szo) {
        if (stripos($string, $sql_szo) !== false) 
        {     
            header($location);
            exit();
        }
    }  

    if (preg_match("/<\s*script.*?\>|<\s*iframe.*?\>|<\s*style.*?\>|<\s*a.*?\>/i", $string)) {
        header($location);
        exit();
    }

    if (preg_match("/[<>{}\[\]\/=;#]/", $string)) {
        header($location);
        exit();
    }

    
    $tiltott_string = 'admin';
    if (stripos($string, $tiltott_string) !== false) {
        header($location);
        exit();
    }

    $tiltott_karomkodasok = array("geci", "fasz", "nyomorék","buzi", "anyád", "faszszopó", "kretén", "pina", "nyomorult", "hülye", "bazdmeg");
    $tiltott_szavak = array("hitler", "sztálin", "náci", "zsidó");

    $string_lowercase = mb_strtolower($string, 'UTF-8');

    foreach ($tiltott_karomkodasok as $karomkodas) {
        if (mb_strpos($string_lowercase, mb_strtolower($karomkodas, 'UTF-8'), 0, 'UTF-8') !== false) {
            header($location);
            exit();
        }
    }

    foreach ($tiltott_szavak as $tiltott_szo) {
        if (mb_strpos($string_lowercase, mb_strtolower($tiltott_szo, 'UTF-8'), 0, 'UTF-8') !== false) {
            header($location);
            exit();
        }
    }

    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    $string = strip_tags($string);

    return $string;
}

?>
