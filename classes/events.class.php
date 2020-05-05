<?php

class Events extends Dbh {
    /**
     * Retrive events between 2 dates
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getEventsBetween (DateTime $start, DateTime $end) : array {
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' And '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->connect()->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    public function getEventsBetweenByDay (DateTime $start, DateTime $end) : array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            }
            else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }
    
}