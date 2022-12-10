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
     * Retrieve a patient from the `patient` table .
     * @return object A patient record. 
     */
    public function getPatientById($patient_id) {
        $sql = "SELECT * FROM patient WHERE patient_id = :patient_id";
        $data = $this->run($sql, [$patient_id])->fetch();
        return $data;
    }

    /**
     * Retrieve all doctors from the `patient` table.
     * @return array A list of patients. 
     */
    public function getAllPatients() {
        $sql = "SELECT * FROM patient";
        $data = $this->paginate($sql);
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

    /**
     * Filter /patients by their first name
     * @param mixed $first_name
     * @return array $data
     */
    public function getPatientsByFirstName($first_name)
    {
        $sql = "SELECT * FROM patient WHERE first_name LIKE ?";
        $data = $this->run($sql, ["%" . $first_name . "%"])->fetchAll();
        return $data;
    }

    /**
     * Filter /patients by their last name
     * @param mixed $last_name
     * @return array $data
     */
    public function getPatientsByLastName($last_name) {
        $sql = "SELECT * FROM patient WHERE last_name LIKE ?";
        $data = $this->run($sql, ["%" . $last_name . "%"])->fetchAll();
        return $data;
    }

    /**
     * Filter /patients by their gender
     * @param mixed $gender
     * @return array $data
     */
    public function getPatientsByGender($gender)
    {
        $sql = "SELECT * FROM patient WHERE gender LIKE ?";
        $data = $this->run($sql, ["" . $gender . "%"])->fetchAll();
        return $data;    
    }
 }