<?php
session_start();

// Verwijder de sessie en stuur de gebruiker terug naar de loginpagina.
session_destroy();
header('Location: login.php');
exit;
?>