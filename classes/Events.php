<?php
require 'debugging.php';

class Events extends Dbh {
    /**
     * Retrieve events between 2 dates
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
    /**
     * Retrieve events between 2 dates by day
     * @param DateTime $start
     * @param DateTime $end
     * @return array
    */
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
    /**
     * Retrieve an event by its id
     * @param int $id
     * @return array 
     */
    public function find(int $id) : theEvent {
        $statement = $this->connect()->query("SELECT * FROM events WHERE id = $id");
        $statement->setFetchMode(PDO::FETCH_CLASS, theEvent::class);
        $result = $statement->fetch();
        //fetch() can return false in case of errors, so we need to handle this problem
        if ($result === false) {
            throw new Exception('Aucun resultat n\'a été trouvé');
        }
        else {
            return $result;
        }
    }
}