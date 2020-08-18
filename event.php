<?php
require 'classes/events.class.php';
require 'views/header.php';
require 'debugging.php';

$event = new Event();
$events = new Events();
if (!isset($_GET['id'])) {
    header('location: 404.php');
}

try {
    $event = $events->find($_GET['id']);
} catch (Exception $e) {
    header('location: 404.php');
    exit();
}

?>

<h1><?= h($event->getName()); ?></h1>
<ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
    <li>Heure de Démarrage: <?= $event->getStart()->format('H:i'); ?></li>
    <li>Description:<br>
        <?= h($event->getDescription()); ?>
    </li>
    <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
</ul>


<?php require 'views/footer.php';