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
        <input type="hidden" name="member[id]" value="<?= $member->id ?>">
        <label for="firstname">
            Nom
            <input
              type="text"
              id="firstname"
              name="member[name]"
              value="<?= $member->name ?>"
              required
                <?= $member->isModerator() ? 'readonly' : '' ?>>
        </label>

        <label for="password">
            Mot de passe
            <input
              type="password"
              id="password"
              name="member[password]"
              value="<?= $member->password ?>"
              required
              readonly
        </label>

        <label for="role">Role</label>
        <select id="role" name="member[role]" required <?= !$member->isModerator() ? 'readonly' : '' ?>>
            <?php foreach (RoleEnum::getValues() as $value): ?>
                <option value="<?= $value ?>" <?= $member->role_id == (int)$value ? 'selected' : '' ?>>
                    <?= RoleEnum::fromValue((int)$value) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="status">Status</label>
        <select name="member[status]" id="role" required <?= !$member->isModerator() ? 'readonly' : '' ?>>
            <?php foreach (StatusEnum::getValues() as $value): ?>
                <option value="<?= $value ?>" <?= $member->status_id == (int)$value ? 'selected' : '' ?>>
                    <?= StatusEnum::fromValue((int)$value) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Button -->
        <button type="submit">Sauvegarder</button>
    </form>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
