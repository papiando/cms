<?php
        exec("git pull >&1",$output,$return_var);
        print_r($output);
?>