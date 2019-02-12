<?php

try
{
    $target = '/home/nzbxjl7it57b/laravel/storage/app/public';
    $shortcut = '/home/nzbxjl7it57b/public_html/storage';
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