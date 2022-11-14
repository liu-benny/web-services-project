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
     * @return object . 
     */
    public function getAllDoctors() {
        $sql = "SELECT * FROM doctor";
        $data = $this->rows($sql);
        return $data;
    }

    /**
     * Retrive information about a given doctor
     * @return
     */
    public function getDoctorById($doctor_id) {
        $sql = "SELECT * FROM doctor WHERE doctor_id = ?";
        $data = $this->run($sql, [$doctor_id])->fetch();
        return $data;
    }

    /**
     * Create one or multiple doctors
     * @return
     */
    public function createDoctors($data) {
        $data = $this->insert($this->doctor_table, $data);
        return $data;
    }

    /**
     * Update one or multiple doctors
     * @return
     */
    public function updateDoctors($doctors) {
        $data = $this->update($this->doctor_table, $doctors['data'], $doctors['where']);
        return $data;
    }

    /**
     * Delete a record from the doctors table
     */
    public function deleteDoctor($doctor_id) {
        $where = ['doctor_id' => $doctor_id];
        $data = $this->delete($this->doctor_table, $where);
        return $data;
    }
}
?>