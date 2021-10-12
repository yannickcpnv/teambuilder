<?php


use TeamBuilder\model\entity\Team;
use TeamBuilder\model\entity\State;
use TeamBuilder\model\entity\TeamMember;

/**@var Team $team */
/**@var TeamMember $member */

ob_start();
$members = $team->getMembers();
?>

    <article>
        <hgroup>
            <h1><?= $team->name ?></h1>
            <h2><?= State::fromValue($team->state_id) ?></h2>
        </hgroup>
        <table>
            <summary><?= count($members) ?> Membres</summary>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Capitaine</th>
                </tr>
            </thead>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= $member->name ?></td>
                    <td><?= $member->is_captain ? " <i class='fas fa-chess-king'></i>" : "" ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </article>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
