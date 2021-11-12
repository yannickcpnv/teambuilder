<?php

/* @var \TeamBuilder\model\entity\Member[] $moderators */

ob_start();
?>

    <h1>Liste des modérateurs</h1>

    <figure>
        <table>
            <thead>
                <tr>
                    <th scope="col" style="width: 1%;">#</th>
                    <th scope="col">Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moderators as $key => $moderator): ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $moderator->name ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </figure>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
