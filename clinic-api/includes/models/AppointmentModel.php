<?php

class AppointmentModel extends BaseModel{

    /**
     * A model class for the `appointment` database table.
     * It exposes operations that can be performed on appointment records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all appointments in a given clinic from the `appointment` table .
     * @return array A list of appointments. 
     */
    public function getAllAppointmentsByClinicId($clinic_id) {

        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                        app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                        app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                        app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = ? ";
        $data = $this->run($sql, [$clinic_id])->fetchAll();
        return $data;
    }

}

    

?>