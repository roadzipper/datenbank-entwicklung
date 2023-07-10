<?php
session_start();

include('classes/StaticHTML.class.php');
include('classes/DB.class.php');


$page = new StaticHTML();
$dbc = new DB();
$db = $dbc->getDatabaseConnection();
$username = $dbc->whoisloggedin();

print $dbc->isAuth();

print $page->head("Wilkommen!");
print $page->navbar($username);

print '<div class="uk-flex uk-flex-center uk-flex-middle uk-flex-column">';

$stmt = "SELECT u.username, p.* FROM user u JOIN posts p USING (uid) ORDER BY p.created DESC";
$result = $db->query($stmt);
while ($row = $result->fetch_assoc()) {
    print $page->post($row);
}

print '</div>';

print $page->foot();
