<?php

class ClinicModel extends BaseModel{

    /**
     * A model class for the `clinic` database table.
     * It exposes operations that can be performed on artists records.
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
        return $clinics;
    }
}

?>