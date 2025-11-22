<?php

include("sk_get_data.php");

// URL se page ka naam
// $pageName = basename($_SERVER['REQUEST_URI'], ".php");
$pageName = basename($_SERVER['PHP_SELF']);

// Default values
$title = 'Metro International LLC';
$description = 'Metro International LLC';

// Check: rows exist?
if (!empty($rows)) {

    // Loop se slug match check karo
    for ($i = 0; $i < count($rows); $i++) {

        if ($pageName == $rows[$i]['slug']) {

            // Correct dynamic values
            $title = $rows[$i]['meta_title'];
            $description = $rows[$i]['meta_description'];

            break; // Match mil gaya → stop loop
        } else {
            $title = 'Metro International LLC';
            $description = 'Metro International';
        }
    }
}
