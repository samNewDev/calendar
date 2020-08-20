<?php

require 'views/header.php';

$oneEvent = new TheEvent();
$events = new Events();
if (!isset($_GET['id'])) {
    header('location: 404.php');
}
//Handeling errors using try/catch in case we get an exception from find()
try {
    $oneEvent = $events->find($_GET['id']);
} catch (Exception $e) {
    header('location: 404.php');
    exit();
}

?>

<h1><?= h($oneEvent->getName()); ?></h1>
<ul>
    <li>Date: <?= $oneEvent->getStart()->format('d/m/Y'); ?></li>
    <li>Heure de Démarrage: <?= $oneEvent->getStart()->format('H:i'); ?></li>
    <li>Description:<br>
        <?= h($oneEvent->getDescription()); ?>
    </li>
    <li>Heure de fin: <?= $oneEvent->getEnd()->format('H:i'); ?></li>
</ul>

<?php require 'views/footer.php';