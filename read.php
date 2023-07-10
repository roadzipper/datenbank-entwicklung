<?php
session_start();

include_once('classes/StaticHTML.class.php');
include_once('classes/DB.class.php');

$page = new StaticHTML();
$dbc = new DB();
$db = $dbc->getDatabaseConnection();

$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT); // Filtern und Importieren der GET-Variablen pid als int

if ($pid) {
    // Beitrag anzeigen und Kommentare abrufen
    postAndComments($pid, $page, $db);
} else {
    // Fehlerbehandlung für ungültige oder fehlende pid
    print "Ungültige oder fehlende Beitrag-ID.";
}

print $page->foot();

// Rekursive Funktion zur Anzeige von Beitrag und Kommentaren
function postAndComments($pid, $page, $db) {
    // Beitrag abrufen
    $stmt = "SELECT * FROM posts WHERE pid = $pid";
    $result = $db->query($stmt);
    $post = $result->fetch_assoc();

    // Beitrag anzeigen
    print $page->post($post);

    // Kommentare abrufen
    $stmt = "SELECT * FROM comments WHERE belongsto = $pid";
    $result = $db->query($stmt);

    // Überprüfen, ob es Kommentare gibt
    if ($result->num_rows > 0) {
        print '<ul class="uk-comment-list">';
        while ($comment = $result->fetch_assoc()) {
            print '<li>';
            print $page->comment($comment);
            // Rekursiver Aufruf für alle Kommentare dieses Kommentars
            postAndComments($comment['cid'], $page, $db);
            print '</li>';
        }
        print '</ul>';
    }
}