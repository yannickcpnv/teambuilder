<?php

use TeamBuilder\model\entity\Team;
use TeamBuilder\model\entity\Member;
use TeamBuilder\model\enum\RoleEnum;
use TeamBuilder\model\enum\StatusEnum;


/** @var Member $member */
/** @var Team[] $teams */
/** @var Team[] $teamsWhereIsCaptain */
/** @var Team[] $teamsWhereIsNotCaptain */

ob_start();
?>

    <h1>Détails du profil</h1>

    <article>
        <hgroup>
            <h2><?= $member->name ?></h2>
            <h3>
                <?php if (!count($teams)): ?>
                    <div>Ce membre ne fait partie d'aucune équipe</div>
                <?php else: ?>
                    <?php if (count($teamsWhereIsCaptain) > 0): ?>
                        <div>Capitaine de : <?= implode(
                                ", ",
                                array_map(function ($team) {
                                    return "<a href=?action=team-details&team-id=" . $team->id . ">
                                                " . $team->name
                                           . "</a>";
                                }, $teamsWhereIsCaptain)
                            ) ?></div>
                    <?php endif; ?>
                    <?php if (count($teamsWhereIsNotCaptain)): ?>
                        <div>Membre de : <?= implode(
                                ", ",
                                array_map(function ($team) {
                                    return "<a href=?action=team-details&team-id=" . $team->id . ">
                                                " . $team->name
                                           . "</a>";
                                }, $teamsWhereIsNotCaptain)
                            ) ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            </h3>
        </hgroup>
        <table>
            <tr>
                <td>Role</td>
                <td><?= RoleEnum::fromValue($member->role_id) ?></td>
            </tr>
            <tr>
                <td>Statut</td>
                <td><?= StatusEnum::fromValue($member->role_id) ?></td>
            </tr>
        </table>
        <div class="flex flex-end">
            <a href="?action=edit-profil&member-id=<?= $member->id ?>" role="button">Passer en mode édition</a>
        </div>
    </article>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
