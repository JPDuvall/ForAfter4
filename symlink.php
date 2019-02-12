<?php

try
{
    $target = '/home/wr1vrszibdio/laravel/ForAfter4/storage/app/public';
    $shortcut = '/home/wr1vrszibdio/public_html/storage';
    $link = symlink($target, $shortcut);
    var_dump($link);
    echo '<br>';
}
catch(Exception $e)
{
    echo 'error<br>';
}

echo __DIR__.'<br>';
echo 'danny allen';