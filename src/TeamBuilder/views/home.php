<?php

ob_start();
?>

    <p><a href="?action=members-list" role="button">Liste des membres</a></p>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
