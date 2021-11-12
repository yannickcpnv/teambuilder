<?php

use TeamBuilder\model\entity\Member;
use TeamBuilder\model\enum\RoleEnum;
use TeamBuilder\model\enum\StatusEnum;


/** @var Member $member */

ob_start();
?>

    <h1>Edition du profil</h1>

<?php if (isset($errorMessage)): ?>
    <p>
        <mark><?= $errorMessage ?></mark>
    </p>
<?php endif; ?>

<?php if (isset($successMessage)): ?>
    <p>
        <ins><?= $successMessage ?></ins>
    </p>
<?php endif; ?>


    <!--TODO : Moderator only last two input-->
    <form method="post" action="?action=save-member">
        <label for="firstname">
            Nom
            <input
              type="text"
              id="firstname"
              name="member[name]"
              value="<?= $member->name ?>"
              required
        </label>

        <label for="password">
            Mot de passe
            <input
              type="password"
              id="password"
              name="member[password]"
              value="<?= $member->password ?>"
              required
                <?= !$member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <label for="role">
            Role
            <input
              type="text"
              id="role"
              name="member[role]"
              required
              value="<?= RoleEnum::fromValue($member->role_id) ?>"
                <?= !$member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <label for="status">
            Statut
            <input
              type="text"
              id="status"
              name="member[status]"
              required
              value="<?= StatusEnum::fromValue($member->status_id) ?>"
                <?= !$member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <!-- Button -->
        <button type="submit">Sauvegarder</button>
    </form>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
