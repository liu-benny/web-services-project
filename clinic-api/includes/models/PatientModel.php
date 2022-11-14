<?php

class PatientModel extends BaseModel{
    private $patient_table = 'patient';
    
    /**
     * A model class for the `patient` database table.
     * It exposes operations that can be performed on doctors records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all doctors from the `patient` table.
     * @return object A list of patients. 
     */
    public function getAllPatients() {
        $sql = "SELECT * FROM patient";
        $data = $this->rows($sql);
        return $data;
    }

    /**
     * Create one or multiple patients
     * @return
     */
    public function createPatients($data) {
        $data = $this->insert($this->patient_table, $data);
        return $data;
    }

    /**
     * Update one or multiple patients
     * @return
     */
    public function updatePatients($patients) {
        $data = $this->update($this->patient_table, $patients['data'], $patients['where']);
        return $data;
    }

    /**
     * Delete a record from the patient table
     */
    public function deletePatient($patient_id) {
        $where = ['patient_id' => $patient_id];
        $data = $this->delete($this->patient_table, $where);
        return $data;
    }
}