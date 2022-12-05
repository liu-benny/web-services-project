<?php

class ScheduleModel extends BaseModel{
    private $schedule_table = 'schedule';
    private $day_of_week_table = 'days_of_week';
    
    /**
     * A model class for the `schedule` database table.
     * It exposes operations that can be performed on schedules records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all doctors from the `schedule` table.
     * @return array A list of schedules. 
     */
    public function getAllSchedules() {
        $sql = "SELECT schedule.schedule_id, schedule.is_available, schedule.doctor_id, days_of_week.day_of_week, days_of_week.time_from, days_of_week.time_to 
                FROM schedule JOIN days_of_week 
                ON schedule.schedule_id = days_of_week.schedule_id";
        $data = $this->paginate($sql);
        return $data;
    }

    /**
     * Create one or multiple schedules
     * @return
     */
    public function createSchedules($data) {
        $data = $this->insert($this->schedule_table, $data);
        return $data;
    }

    /**
     * Update one or multiple schedules
     * @return
     */
    public function updateSchedules($schedules) {
        $data = $this->update($this->schedule_table, $schedules['data'], $schedules['where']);
        return $data;
    }

    /**
     * Delete a record from the schedule table
     */
    public function deleteSchedule($schedule_id) {
        $where = ['schedule_id' => $schedule_id];
        $data = $this->delete($this->schedule_table, $where);
        return $data;
    }

    /**
     * Create one or multiple days_of_week for one or multiple schedules
     * @param mixed $data
     * @return bool|string
     */
    public function createScheduleDetails($data) {
        $data = $this->insert($this->day_of_week_table, $data);
        return $data;
    }

    /**
     * Get all schedules filtering by a day of week
     */
    public function getSChedulesByDayOfWeek($day_of_week)
    {
        $sql = "SELECT schedule.schedule_id, schedule.is_available, schedule.doctor_id, days_of_week.day_of_week, days_of_week.time_from, days_of_week.time_to 
                FROM schedule JOIN days_of_week 
                ON schedule.schedule_id = days_of_week.schedule_id
                WHERE days_of_week.day_of_week LIKE ?";
        $data = $this->run($sql, ["%" . $day_of_week . "%"])->fetchAll();
        return $data;
    }
}
