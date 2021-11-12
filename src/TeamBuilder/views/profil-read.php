<?php

use TeamBuilder\model\entity\Member;
use TeamBuilder\model\enum\RoleEnum;
use TeamBuilder\model\enum\StatusEnum;


/** @var Member $connectedMember */

ob_start();
?>

    <h1>Consultation de votre profil</h1>

    <article>
        <div class="grid">
            <div><strong>Nom</strong></div>
            <div><?= $connectedMember->name ?></div>
        </div>
        <div class="grid">
            <div><strong>Role</strong></div>
            <div><?= RoleEnum::fromValue($connectedMember->role_id) ?></div>
        </div>
        <div class="grid">
            <div><strong>Statut</strong></div>
            <div><?= StatusEnum::fromValue($connectedMember->role_id) ?></div>
        </div>
    </article>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
