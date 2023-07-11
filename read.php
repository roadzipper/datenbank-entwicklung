<?php
session_start();

include_once('classes/StaticHTML.class.php');
include_once('classes/DB.class.php');

$page = new StaticHTML();
$dbc = new DB();
$db = $dbc->getDatabaseConnection();

$pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_INT);

if ($pid) {
    // Beitrag anzeigen und Kommentare abrufen
    postAndComments($pid, $page, $db);
    
    // Formular zum Erstellen eines Beitrags anzeigen
    echo '
    <form method="post" action="read.php?pid=' . $pid . '">
        <input type="text" name="title" placeholder="Titel" required>
        <textarea name="content" placeholder="Inhalt" required></textarea>
        <input type="submit" name="submit" value="Beitrag erstellen">
    </form>';
} else {
    // Fehlerbehandlung für ungültige oder fehlende pid
    echo "Ungültige oder fehlende Beitrag-ID.";
}

echo $page->foot();

// Rekursive Funktion zur Anzeige von Beitrag und Kommentaren
function postAndComments($pid, $page, $db) {
    // Beitrag abrufen
    $stmt = "SELECT * FROM posts WHERE pid = $pid";
    $result = $db->query($stmt);
    $post = $result->fetch_assoc();

    // Beitrag anzeigen
    echo $page->post($post);

    // Kommentare abrufen
    $stmt = "SELECT * FROM comments WHERE belongsto = $pid";
    $result = $db->query($stmt);

    // Überprüfen, ob es Kommentare gibt
    if ($result->num_rows > 0) {
        echo '<ul class="uk-comment-list">';
        while ($comment = $result->fetch_assoc()) {
            echo '<li>';
            echo $page->comment($comment);
            // Rekursiver Aufruf für alle Kommentare dieses Kommentars
            postAndComments($comment['cid'], $page, $db);
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
