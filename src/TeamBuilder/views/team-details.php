<?php


use TeamBuilder\model\entity\Team;
use TeamBuilder\model\enum\StateEnum;
use TeamBuilder\model\entity\TeamMember;

/**@var Team $team */
/**@var TeamMember $teamMember */

ob_start();
$teamMembers = $team->getTeamMembers();
?>

    <h1>Détail de l'équipe "<?= $team->name ?>"</h1>

    <article>
        <hgroup>
            <h2><?= $team->name ?></h2>
            <h3><?= StateEnum::fromValue($team->state_id) ?></h3>
        </hgroup>
        <table>
            <summary>Il y a <?= count($teamMembers) ?> Membres dans l'équipe</summary>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Capitaine</th>
                </tr>
            </thead>
            <?php foreach ($teamMembers as $teamMember): ?>
                <tr>
                    <td><?= $teamMember->name ?></td>
                    <td><?= $teamMember->is_captain ? " <i class='fas fa-chess-king'></i>" : "" ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </article>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
