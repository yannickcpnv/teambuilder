<?php

ob_start();
?>

    <h1>Créer une équipe</h1>

<?php if (isset($errorMessage)): ?>
    <p>
        <mark><?= $errorMessage ?></mark>
    </p>
<?php endif; ?>

    <form method="post" action="?action=save-team">
        <label for="firstname">
            Nom de l'équipe
            <input type="text" id="firstname" name="team[name]" placeholder="Inscrivez le nom de l'équipe" required>
        </label>

        <!-- Button -->
        <button type="submit">Créer</button>
    </form>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
