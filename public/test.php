<?php
$files = glob('public/front/services/next_service/*.png');
foreach($files as $f){
    $size=getimagesize($f);
    echo basename($f).' : '.$size[0].'x'.$size[1]."\n";
}
