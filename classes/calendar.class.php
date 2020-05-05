<?php

class Calendar
{
  public $weeksDefaultNum = 6;
  public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  private $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
  public $month;
  public $year;

  function __construct(?int $month = null, ?int $year = null) {
    if ($month == null || $month > 12 || $month < 1) {
      $month = intval(date('m'));
    }
    if ($year == null) {
      $year = intval(date('Y'));
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

  public function isCurrentMonth(DateTime $currentDay) : bool {
    return $this->firstDayOfTheWeek()->format('Y-m') === $currentDay->format('Y-m');
  }

  public function nextMonth() : Calendar {
    $month = $this->month + 1;
    $year = $this->year;
    if ($month > 12) {
      $month = 1;
      $year += 1; 
    }
    return new Calendar($month, $year);
  }

  public function previousMonth() : Calendar {
    $month = $this->month - 1;
    $year = $this->year;
    if ($month < 0) {
      $month = 12;
      $year -= 1; 
    }
    return new Calendar($month, $year);
  }
}
