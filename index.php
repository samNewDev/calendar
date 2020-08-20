<?php
  require 'views/header.php';
?>

    <?php
      $events = new Events();
      $month = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
      $firstDay = $month->firstDayOfTheMonth()->modify('last monday');
      $end = (clone $firstDay)->modify('+41 days');
      $events = $events->getEventsBetweenByDay($firstDay, $end);
    ?>
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
      <h1><?= $month->displayDate() ?></h1>
      <div>
        <a href="index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-dark">&lt;</a>
        <a href="index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-dark">&gt;</a>
      </div>
    </div>
    <div class="calendar">
    <table class="table table-bordered table-success calendar_table">
        <?php for($i=0; $i<$month->weeksDefaultNum; $i++) : ?>
        <tr>
            <?php foreach ($month->days as $key => $day):
              $currentDay = (clone $firstDay)->modify('+'.$key + 7*$i.' day');
              $eventOfDay = $events[$currentDay->format('Y-m-d')] ?? [];
            ?>
            <td id="<?= $month->isCurrentMonth($currentDay) ? '' : 'calendar_notCurrentMonth'; ?>"class="calendar_weeks">
                <?php if($i == 0) : ?>
                  <div class="calendar_weekdays"> <?= $day . '<br>'; ?> </div>
                <?php endif; ?>
                <div><?= intval($currentDay->format('d')); ?></div>


                
                <?php foreach ($eventOfDay as $event) : ?>
                  <div class="calendar_event">
                    <?= (new DateTime($event['start']))->format('H:i') ?> - <a href="event.php/?id=<?= $event['id'] ?>"><?= $event['name']; ?></a>
                  </div>
                <?php endforeach; ?>
            </td>
            <?php endforeach; ?>
        </tr>
      <?php endfor; ?>
    </table>
<!--
    <a href="addEvent.php" class="calendar_buttonAddEvents">+</a>
-->
    </div>

<?php
  require 'views/footer.php';
?>
