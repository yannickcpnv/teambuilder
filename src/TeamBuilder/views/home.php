<?php

ob_start();
?>

    <p><a href="#" role="button" onclick="event.preventDefault()">Call to action</a></p>


<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
