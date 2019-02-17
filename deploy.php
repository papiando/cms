<?php
        exec("git pull >&1",$output,$return_var);
		exec("find . -type f -exec chmod 644 {} \; >&1",$outnull,$return_var);
		exec("find . -type d -exec chmod 755 {} \; >&1",$outnull,$return_var);
        print_r($output);
?>