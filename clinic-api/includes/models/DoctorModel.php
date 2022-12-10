<?php

class DoctorModel extends BaseModel{
    private $doctor_table = "doctor";

    /**
     * A model class for the `doctor` database table.
     * It exposes operations that can be performed on doctors records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all doctors from the `doctors` table.
     * @return array $data
     */
    public function getAllDoctors() {
        $sql = "SELECT * FROM doctor";
        $data = $this->paginate($sql);
        return $data;
    }

    /**
     * Retrive information about a given doctor
     * @return array $data
     */
    public function getDoctorById($doctor_id) {
        $sql = "SELECT * FROM doctor WHERE doctor_id = ?";
        $data = $this->run($sql, [$doctor_id])->fetch();
        return $data;
    }

    /**
     * Create one or multiple doctors
     * @return bool|string $data
     */ 
    public function createDoctors($data) {
        $data = $this->insert($this->doctor_table, $data);
        return $data;
    }

    /**
     * Update one or multiple doctors
     * @return bool|string $data
     */
    public function updateDoctors($doctors) {
        $data = $this->update($this->doctor_table, $doctors['data'], $doctors['where']);
        return $data;
    }

    /**
     * Delete a record from the doctors table
     * @return bool|string $data
     */
    public function deleteDoctor($doctor_id) {
        $where = ['doctor_id' => $doctor_id];
        $data = $this->delete($this->doctor_table, $where);
        return $data;
    }

    /**
     * Get a schedule record of a specified doctor
     */
    public function getDoctorSchedule($doctor_id) {
        $sql = "SELECT doctor.doctor_id, schedule.schedule_id, schedule.is_available, days_of_week.day_of_week, days_of_week.time_from, days_of_week.time_to 
                FROM doctor JOIN schedule ON doctor.doctor_id = schedule.schedule_id 
                            JOIN days_of_week ON schedule.schedule_id = schedule.schedule_id
                            WHERE doctor.doctor_id = ?
                            AND schedule.schedule_id = days_of_week.schedule_id";
        $data = $this->run($sql, [$doctor_id])->fetchAll();
        return $data;
    }
 }
?>
