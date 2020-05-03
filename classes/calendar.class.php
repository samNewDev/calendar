<?php
/**
 *
 */
class Calendar
{
  public $khra;
  public $weeksDefaultNum = 6;
  public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  private $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
  private $month;
  private $year;

  function __construct(?int $month = null, ?int $year = null) {
    if ($month == null) {
      $month = intval(date('m'));
    }
    if ($year == null) {
      $year = intval(date('Y'));
    }
    if ($month > 12 || $month < 1) {
      $month = $month % 12;
    }
    $this->month = $month;
    $this->year = $year;
  }

  public function displayDate() : string {
    return $this->months[$this->month - 1] . " " . $this->year;
  }

  public function firstDayOfTheWeek() : DateTime {
    return new DateTime("$this->year-$this->month-01");
  }

  public function getWeeksNum() : int {
    $start = $this->firstDayOfTheWeek();
    $end = (clone $start)->modify("+1 month -1 day");
    return intval($end->format('W')) - intval($start->format('W')) + 1;
  }


}
