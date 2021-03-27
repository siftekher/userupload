<?php

for($counter=1; $counter<=100; $counter++){
    if($counter % 3 == 0 && $counter % 5 == 0) echo 'foobar, ';
    elseif($counter % 3 == 0) echo 'foo, ';
    elseif($counter % 5 == 0) echo 'bar, ';
    else echo $counter . ', ';
}

?>