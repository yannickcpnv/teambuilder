<?php

ob_start();

$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
