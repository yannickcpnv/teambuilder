<?php

/* @var \TeamBuilder\model\entity\Member[] $members */

ob_start();
?>

    <table>
        <thead>
            <tr>
                <th scope="col">Membre</th>
                <th scope="col">Équipe(s)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($members as $member): ?>
                <tr>
                    <td><?= $member->name ?></td>
                    <td>
                        <?= implode(
                            ", ",
                            array_map(function ($team) {
                                return "<a href=?action=team-details&team-id=" . $team->id . ">" . $team->name . "</a>";
                            }, $member->getTeams())
                        ) ?>
                    </td>
                </tr>
            <?php
            endforeach ?>
        </tbody>
    </table>

<?php
$content = ob_get_clean();
require 'src/TeamBuilder/views/includes/layout.php';
