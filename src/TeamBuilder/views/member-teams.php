<?php

use TeamBuilder\model\entity\Team;
use TeamBuilder\model\enums\StateEnum;

/* @var Team[] $teams */

ob_start();
?>

    <figure>
        <table>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Nombre de membres</th>
                    <th scope="col">Capitaine</th>
                    <th scope="col">État</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($teams as $team): ?>
                    <tr>
                        <td><a href="?action=team-details&team-id=<?= $team->id ?>"><?= $team->name ?></a></td>
                        <td><?= count($team->getMembers()) ?></td>
                        <td><?= $team->getCaptain()->name ?></td>
                        <td><?= StateEnum::fromValue($team->state_id) ?></td>
                    </tr>
                <?php
                endforeach ?>
            </tbody>
        </table>
    </figure>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
