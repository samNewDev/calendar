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
    <h1><?= $month->displayDate() ?></h1>

    <table class="table table-bordered table-success calendar_table">
        <?php for($i=0; $i<$month->weeksDefaultNum; $i++) : ?>
        <tr>
            <?php foreach ($month->days as $key => $day):
              $currentDay = (clone $firstDay)->modify('+'.$key + 7*$i.' day');
              ?>
              <td id="<?= $month->isCurrentMonth($currentDay) ? '' : 'calendar_notCurrentMonth'; ?>" class="calendar_weeks">
                <?php if($i == 0) : ?>
                  <div class="calendar_weekdays"> <?= $day . '<br>'; ?> </div>
                <?php endif; ?>
                <div>
                  <?php echo intval($currentDay->format('d')); ?>
                </div>
              </td>
            <?php endforeach; ?>
        </tr>
      <?php endfor; ?>
    </table>
  </body>
</html>
