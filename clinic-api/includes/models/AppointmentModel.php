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
    public function getAppointmentsByClinicId($clinic_id) {

        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                        app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                        app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                        app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = :clinic_id ";
        $data = $this->paginate($sql, [":clinic_id" => $clinic_id]);
        return $data;
    }

    /**
     * Retrieve all appointments from a given patient from the `appointment` table .
     * @return array A list of appointments. 
     */
    public function getAppointmentsByPatientId($patient_id){
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                        app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                        app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                        app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.patient_id = :patient_id ";
        $data = $this->paginate($sql, [":patient_id" => $patient_id]);
        return $data;
    }

    /**
     * Retrieve all appointments in a given clinic and given patient from the `appointment` table .
     * @return array A list of appointments. 
     */
    public function getAppointmentsByClinicAndPatientId($clinic_id,$patient_id){
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                        app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                        app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                        app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = :clinic_id AND app.patient_id = :patient_id " ;
        $data = $this->run($sql, [":clinic_id" => $clinic_id,
                                  ":patient_id" => $patient_id])->fetchAll();
        return $data;
    }


    /**
     * Create one or multiple appointment
     * @return bool|string $data
     */
    public function createAppointments($data){
        $data = $this->insert("appointment", $data);
        return $data;
    }
    
    /**
     * Update one or multiple appointment
     * @return bool|string $data
     */
    public function updateAppointments($data ,$where){
        $data = $this->update("appointment", $data, $where);
        return $data;
    }

    /**
     * Delete a record from the appointment table
     * @return bool|string $data
     */
    public function deleteAppointment($appointment_id) {
        $where = ['appointment_id' => $appointment_id];
        $data = $this->delete("appointment", $where);
        return $data;
    }

    /**
     * Filter a list of appointments by date
     * @param mixed $date
     * @return array $data
     */
    public function getAppointmentsByDate($patient_id, $datetime) {
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.patient_id = :patient_id 
                AND app.time_from LIKE :time_from";
        $data = $this->paginate($sql, [":patient_id" => $patient_id, "time_from" => "%" . $datetime . "%"]);
        return $data;
    }

    /**
     * Get appointment of a given patient at a given clinic, filter by date
     * @param mixed $date
     * @return array $data
     */
    public function getAppointmentsByClinicAndPatientIdAndDate($clinic_id, $patient_id, $datetime) {
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.patient_id = :patient_id 
                AND app.clinic_id = :clinic_id  
                AND app.time_from LIKE :time_from";
        $data = $this->paginate($sql, [":patient_id" => $patient_id , ":clinic_id" => $clinic_id, "time_from" => "%" . $datetime . "%"]);
        return $data;
    }

    /**
     * filter a list of appointment at a given clinic by date
     * @param mixed $clinic_id
     * @param mixed $datetime
     * @return array $data
     */
    public function getAppointmentsByClinicAndDate($clinic_id, $datetime){
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = :clinic_id  
                AND app.time_from LIKE :time_from";
        $data = $this->paginate($sql, [":clinic_id" => $clinic_id, "time_from" => "%" . $datetime . "%"]);
        return $data;
    }

    /**
     * filter a list of appointment at a given clinic by patient's  first name
     * @param mixed $clinic_id
     * @param mixed $first_name
     * @return array $data
     */
    public function getAppointmentsByClinicAndFirstName($clinic_id, $first_name){
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = :clinic_id  
                AND app.first_name LIKE :first_name";
        $data = $this->paginate($sql, [":clinic_id" => $clinic_id, "first_name" => "%" . $first_name . "%"]);
        return $data;
    }

    /**
     * Sfilter a list of appointment at a given clinic by patient's  last name
     * @param mixed $clinic_id
     * @param mixed $last_name
     * @return array $data
     */
    public function getAppointmentsByClinicAndLastName($clinic_id, $last_name){
        $sql = "SELECT app.appointment_id, app.time_from, app.time_to, 
                app.clinic_id, clinic.clinic_name, clinic.clinic_address, 
                app.patient_id, patient.first_name AS patient_first_name, patient.last_name AS patient_last_name, 
                app.doctor_id, doctor.first_name AS doctor_first_name, doctor.last_name AS doctor_last_name 
                FROM appointment AS app 
                JOIN clinic ON clinic.clinic_id = app.clinic_id 
                JOIN patient ON patient.patient_id = app.patient_id 
                JOIN doctor ON doctor.doctor_id = app.doctor_id 
                WHERE app.clinic_id = :clinic_id  
                AND app.last_name LIKE :last_name";
        $data = $this->paginate($sql, [":clinic_id" => $clinic_id, "last_name" => "%" . $last_name . "%"]);
        return $data;
    }
}
?>