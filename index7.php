<?php
// Example 1
$pizza  = "piece1 Fabricio piece2 piece3 piece4 piece5 piece6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; // piece1
echo "<br>";
echo $pieces[1]; // piece2
echo "<br>";

// Example 2
$data = "foo:Fabricio:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo "<br>";
echo $pass; // *
echo "<br>";

?>