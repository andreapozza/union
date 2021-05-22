<?php 
echo '<hr>';
echo '<p>$ git fetch origin; git reset --hard origin/main<p>';
echo '<hr>';
exec( 'git fetch origin; git reset --hard origin/main', $output1 ); 
foreach ($output1 as $string) {
    echo "<p>$string</p>";
}
echo '<hr>';
echo '<p>$ git status</p>';
echo '<hr>';
exec( 'git status', $output2 ); 
foreach ($output2 as $string) {
    echo "<p>$string</p>";
}
echo '<hr>';
echo '<p>$ git log -n 3</p>';
echo '<hr>';
exec( 'git log -n 3', $output3 ); 
foreach ($output3 as $string) {
    echo "<p>$string</p>";
}