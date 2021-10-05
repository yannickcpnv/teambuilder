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
                            array_map(fn($obj) => $obj->name, $member->teams())
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
