<?php
    $membernames = $_POST["membername"];
    $memberapes = $_POST["memberape"];
    $memberinstruments = $_POST["memberinstruments"];
    $memberages = $_POST["memberages"];
    
    for($i=0; $i<count($membername); $i++)
    {
        for($j=0; $j<3; $j++)
        {
            $member[$i][$j] = $membernames[$j];
            $member[$i][$j] = $memberapes[$j];
            $member[$i][$j] = $memberinstruments[$j];
            $member[$i][$j] = $memberages[$j];
        }
    }