<?php

ob_start();
?>

    <h1>Edition du profil</h1>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
