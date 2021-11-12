<?php

/* @var \TeamBuilder\model\entity\Member[] $members */

ob_start();
?>

    <h1>Liste des membres</h1>

    <figure>
        <table>
            <thead>
                <tr>
                    <th scope="col">Membre</th>
                    <th scope="col">Équipe(s)</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($members as $member): ?>
                    <?php $displayModNomination = !$member->isModerator()
                                                  && unserialize($_SESSION['web-user'])->isModerator() ?>
                    <tr>
                        <td><a href="?action=read-profil&member-id=<?= $member->id ?>"><?= $member->name ?></a></td>
                        <td>
                            <?= implode(
                                ", ",
                                array_map(function ($team) {
                                    return "<a href=?action=team-details&team-id=" . $team->id . ">
                                                " . $team->name
                                           . "</a>";
                                }, $member->getTeams())
                            ) ?>
                        </td>
                        <td>
                            <?php if ($displayModNomination): ?>
                                <a href="?action=nominate-moderator&member-id=<?= $member->id ?>">
                                    <i class="fas fa-users-cog"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                endforeach ?>
            </tbody>
        </table>
    </figure>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
