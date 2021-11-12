<?php

use TeamBuilder\model\entity\Member;


/** @var Member $member */

ob_start();
?>

    <h1>Edition du profil</h1>

<?php if (isset($errorMessage)): ?>
    <p>
        <mark><?= $errorMessage ?></mark>
    </p>
<?php endif; ?>

    <form method="post" action="?action=edit-team-member">
        <label for="firstname">
            Nom
            <input
              type="text"
              id="firstname"
              name="member[name]"
              placeholder="Inscrivez le nom du membre"
              required
        </label>

        <label for="password">
            Mot de passe
            <input
              type="text"
              id="password"
              name="member[password]"
              placeholder="Inscrivez le mot de passe"
              required
                <?= $member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <label for="role">
            Role
            <input
              type="text"
              id="role"
              name="member[role]"
              placeholder="Sélectionnez le role"
              required
                <?= $member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <label for="status">
            Statut
            <input
              type="text"
              id="status"
              name="member[status]"
              placeholder="Sélectionnez le statut"
              required
                <?= $member->isModerator() ? 'disabled' : '' ?>>
        </label>

        <!-- Button -->
        <button type="submit">Sauvegarder</button>
    </form>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
