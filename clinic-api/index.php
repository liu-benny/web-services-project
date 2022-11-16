<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './includes/app_constants.php';
require_once './includes/helpers/helper_functions.php';

//--Step 1) Instantiate App.
$app = AppFactory::create();

//-- Step 2) Add routing middleware.
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
//-- Step 3) Add error handling middleware.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
//-- Step 4)
// TODO: change the name of the sub directory here. You also need to change it in .htaccess
$app->setBasePath("/web-services-project/clinic-api");

//-- Step 5) Include the files containing the definitions of the callbacks.
require_once './includes/routes/clinics_routes.php';
require_once './includes/routes/doctors_routes.php';
require_once './includes/routes/patients_routes.php';

//-- Step 6)
// TODO: And here we define app routes. 
// Define app routes.
$app->get("/clinics","handleGetAllClinics");
$app->post("/clinics","handleCreateClinics");
$app->put("/clinics","handleUpdateClinics");
$app->delete("/clinics/{clinic_id}","handleDeleteClinic");
$app->get("/clinics/{clinic_id}/departments", "handleGetAllDepartments");
$app->post("/clinics/{clinic_id}/departments", "handleCreateDepartments");
$app->put("/clinics/{clinic_id}/departments", "handleUpdateDepartments");
$app->delete("/clinics/{clinic_id}/departments/{department_id}", "handleDeleteDepartment");
$app->get("/clinics/{clinic_id}/doctors", "handleGetAllDoctorInOneClinic");
$app->get("/clinics/{clinic_id}/appointments","handleGetAllAppointmentsByClinicId");

// URI: /doctors
$app->get("/doctors","handleGetAllDoctors");
$app->get("/doctors/{doctor_id}","handleGetDoctorById");
$app->post("/doctors","handleCreateDoctors");
$app->put("/doctors","handleUpdateDoctors");
$app->delete("/doctors/{doctor_id}","handleDeleteDoctor");

// URI: /patients
$app->get("/patients","handleGetAllPatients");
$app->post("/patients","handleCreatePatients");
$app->put("/patients","handleUpdatePatients");
$app->delete("/patients/{patient_id}","handleDeletePatient");



// Run the app.
$app->run();
