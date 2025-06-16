<?php
if (!isset($_GET['link'])) {
    die("Link não especificado.");
}

$link = filter_var($_GET['link'], FILTER_VALIDATE_URL);

if (!$link) {
    die("URL inválida.");
}

header("Location: $link");
exit;
