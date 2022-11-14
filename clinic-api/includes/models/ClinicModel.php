<?php

class ClinicModel extends BaseModel{
    private $department_table = "department";

    /**
     * A model class for the `clinic` database table.
     * It exposes operations that can be performed on doctors records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all clinics from the `clinic` table.
     * @return array A list of clinics. 
     */
    public function getAllClinics() {
        $sql = "SELECT * FROM clinic";
        $data = $this->rows($sql);
        return $data;
    }

    /**
     * Create clinic(s) for the `clinic` table.
     * @return array A list of clinics. 
     */
    public function createClinic($clinics){
        $clinics = $this->insert("clinic",$clinics);
        return $clinics;
    }
    
    /**
     * Update clinic(s) for the `clinic` table.
     * @return array A list of clinics. 
     */
    public function updateClinic($clinics,$where){
        $clinics = $this->update("clinic",$clinics,$where);
        return $clinics;
    }
    
    /**
     * Delete clinic for the `clinic` table.
     * @return array A list of clinics. 
     */
    public function deleteClinic($where){
        $clinic = $this->delete("clinic",$where);
        return $clinic;
    }

    /**
     * Get all departments of a given clinic
     * @return array A list of departments
     */
    public function getAllDepartments($clinic_id){ 
        $sql = "SELECT * FROM department WHERE clinic_id = ?";
        $data = $this->run($sql, [$clinic_id])->fetchAll();
        return $data;
    }

    /**
     * Create one or more departments for a given clinic
     * @return 
     */
    public function createDepartments($data) {
        $data = $this->insert($this->department_table, $data);
        return $data;
    }

    /**
     * Update one or more given department in a given clinic
     * @return
     */
    public function updateDepartment($departments) {
        $data = $this->update($this->department_table, $departments['data'], $departments['where']);
        return $data;
    }

    /**
     * Delete a given department in a given clinic
     */
    public function deleteDepartment($department_id) {
        $where = ['department_id' => $department_id];
        $data = $this->delete($this->department_table, $where);
        return $data;
    }

    /**
     * Get all doctors in a given clinic
     */
    public function getAllDoctors($clinic_id) {
        $sql = "SELECT * FROM doctor JOIN department ON doctor.department_id = department.department_id WHERE department.clinic_id = ?;";
        $data = $this->run($sql, [$clinic_id])->fetchAll();
        return $data;
    }
}
?>