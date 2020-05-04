<?php
include "includes/myautoload.inc.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-success">
        <a class="navbar-brand" href="index.php">My Calendar</a>
    </nav>
    <?php
      $month = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
      $firstDay = $month->firstDayOfTheWeek()->modify('last monday');
    ?>
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
      <h1><?= $month->displayDate() ?></h1>
      <div>
        <a href="index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-dark">&lt;</a>
        <a href="index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-dark">&gt;</a>
      </div>
    </div>
    
    <table class="table table-bordered table-success calendar_table">
        <?php for($i=0; $i<$month->weeksDefaultNum; $i++) : ?>
        <tr>
            <?php foreach ($month->days as $key => $day):
              $currentDay = (clone $firstDay)->modify('+'.$key + 7*$i.' day');
              ?>
              <td id="<?= $month->isCurrentMonth($currentDay) ? '' : 'calendar_notCurrentMonth'; ?>"class="calendar_weeks">
                <?php if($i == 0) : ?>
                  <div class="calendar_weekdays"> <?= $day . '<br>'; ?> </div>
                <?php endif; ?>
                <div>
                  <?= intval($currentDay->format('d')); ?>
                </div>
              </td>
            <?php endforeach; ?>
        </tr>
      <?php endfor; ?>
    </table>
  </body>
</html>
