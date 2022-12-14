<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './includes/app_constants.php';
require_once './includes/helpers/helper_functions.php';
require_once './includes/helpers/JWTManager.php';
require_once './includes/helpers/Paginator.php';
require_once './includes/helpers/WebServiceInvoker.php';

define('APP_BASE_DIR', __DIR__);
// IMPORTANT: This file must be added to your .ignore file. 
define('APP_ENV_CONFIG', 'config.env');

$api_base_path = "/web-services-project/clinic-api";

//--Step 1) Instantiate App.
$app = AppFactory::create();

//-- Step 2) Add routing middleware.
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
//-- Step 3) Add error handling middleware.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
//-- Step 4)
// TODO: change the name of the sub directory here. You also need to change it in .htaccess
$app->setBasePath($api_base_path);

$jwt_secret = JWTManager::getSecretKey();
$app->add(new Tuupola\Middleware\JwtAuthentication([
            'secret' => $jwt_secret,
            'algorithm' => 'HS256',
            'secure' => false, // only for localhost for prod and test env set true            
            "path" => $api_base_path, // the base path of the API
            "attribute" => "decoded_token_data",
            "ignore" => ["$api_base_path/token", "$api_base_path/account"],
            "error" => function ($response, $arguments) {
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                $response->getBody()->write(
                        json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
                );
                return $response->withHeader("Content-Type", "application/json;charset=utf-8");
            }
        ]));

//-- Step 5) Include the files containing the definitions of the callbacks.

require_once './controllers/CanadaCasesController.php';
require_once './controllers/HealthCareController.php';
require_once './includes/routes/clinics_routes.php';
require_once './includes/routes/doctors_routes.php';
require_once './includes/routes/patients_routes.php';
require_once './includes/routes/appointment_routes.php';
require_once './includes/routes/schedules_routes.php';
require_once './includes/routes/remote_resources_routes.php';
require_once './includes/routes/token_routes.php';



//-- Step 6)
// TODO: And here we define app routes. 
// Define app routes.

// User authentication
$app->post("/token", "handleGetToken");
$app->post("/account", "handleCreateUserAccount");

// URI: /clinics
$app->get("/clinics","handleGetCanadaCases");
$app->post("/clinics","handleCreateClinics");
$app->put("/clinics","handleUpdateClinics");
$app->delete("/clinics","handleUnsupportedOperation"); // -- This is not supported.

//URI: /clinics/{clinic_id}
$app->get("/clinics/{clinic_id}","getClinicAndArticlesResource"); 
$app->post("/clinics/{clinic_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/clinics/{clinic_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/clinics/{clinic_id}","handleDeleteClinic");

//URI: /clinics/{clinic_id}/departments
$app->get("/clinics/{clinic_id}/departments", "handleGetAllDepartments");
$app->post("/clinics/{clinic_id}/departments", "handleCreateDepartments");
$app->put("/clinics/{clinic_id}/departments", "handleUpdateDepartments");
$app->delete("/clinics/{clinic_id}/departments", "handleUnsupportedOperation"); // -- This is not supported.

//URI: /clinics/{clinic_id}/departments/{department_id}
$app->get("/clinics/{clinic_id}/departments/{department_id}", "handleUnsupportedOperation"); // -- This is not supported.
$app->post("/clinics/{clinic_id}/departments/{department_id}", "handleUnsupportedOperation"); // -- This is not supported.
$app->put("/clinics/{clinic_id}/departments/{department_id}", "handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/clinics/{clinic_id}/departments/{department_id}", "handleDeleteDepartment");

//URI: /clinics/{clinic_id}/doctors
$app->get("/clinics/{clinic_id}/doctors", "handleGetAllDoctorInOneClinic");
$app->post("/clinics/{clinic_id}/doctors", "handleUnsupportedOperation"); // -- This is not supported.
$app->put("/clinics/{clinic_id}/doctors", "handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/clinics/{clinic_id}/doctors", "handleUnsupportedOperation"); // -- This is not supported.

//URI: /clinics/{clinic_id}/appointments
$app->get("/clinics/{clinic_id}/appointments","handleGetAppointmentsByClinicId");
$app->post("/clinics/{clinic_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/clinics/{clinic_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/clinics/{clinic_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.

//URI: /clinics/{clinic_id}/patients/{patient_id}/appointments
$app->get("/clinics/{clinic_id}/patients/{patient_id}/appointments","handleGetAppointmentsByClinicAndPatientId");
$app->post("/clinics/{clinic_id}/patients/{patient_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/clinics/{clinic_id}/patients/{patient_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/clinics/{clinic_id}/patients/{patient_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.


// URI: /doctors
$app->get("/doctors","handleGetAllDoctors");
$app->post("/doctors","handleCreateDoctors");
$app->put("/doctors","handleUpdateDoctors");
$app->delete("/doctors","handleUnsupportedOperation"); // -- This is not supported.

//URI: /doctors/{doctor_id}
$app->get("/doctors/{doctor_id}","handleGetDoctorById");
$app->post("/doctors/{doctor_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/doctors/{doctor_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/doctors/{doctor_id}","handleDeleteDoctor");

//URI: /doctors/{doctor_id}/schedule
$app->get("/doctors/{doctor_id}/schedule","handleGetDoctorSchedule");
$app->post("/doctors/{doctor_id}/schedule","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/doctors/{doctor_id}/schedule","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/doctors/{doctor_id}/schedule","handleUnsupportedOperation"); // -- This is not supported.

// URI: /patients
$app->get("/patients","handleGetAllPatients");
$app->post("/patients","handleCreatePatients");
$app->put("/patients","handleUpdatePatients");
$app->delete("/patients","handleUnsupportedOperation"); // -- This is not supported.

//URI: /patients/{patient_id}
$app->get("/patients/{patient_id}","handleGetPatientById");
$app->post("/patients/{patient_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/patients/{patient_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/patients/{patient_id}","handleDeletePatient");

//URI: /patients/{patient_id}/appointments
$app->get("/patients/{patient_id}/appointments","handleGetAppointmentsByPatientId");
$app->post("/patients/{patient_id}/appointments","handleCreateAppointmentByPatientId");
$app->put("/patients/{patient_id}/appointments","handleUpdateAppointmentByPatientId");
$app->delete("/patients/{patient_id}/appointments","handleUnsupportedOperation"); // -- This is not supported.


//URI: /schedules
$app->get("/schedules","handleGetAllSchedules");
$app->post("/schedules","handleCreateSchedules");
$app->put("/schedules","handleUpdateSchedules");
$app->delete("/schedules","handleUnsupportedOperation"); // -- This is not supported.

//URI: /schedules/days_of_week
$app->get("/schedules/days_of_week","handleUnsupportedOperation"); // -- This is not supported.
$app->post("/schedules/days_of_week","handleCreateSChedulesDetails");
$app->put("/schedules/days_of_week","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/schedules/days_of_week","handleUnsupportedOperation"); // -- This is not supported.

//URI: /schedules/{schedule_id}
$app->get("/schedules/{schedule_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->post("/schedules/{schedule_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->put("/schedules/{schedule_id}","handleUnsupportedOperation"); // -- This is not supported.
$app->delete("/schedules/{schedule_id}","handleDeleteSchedule");

// Show app routes.
$app->get('/', function (Request $request, Response $response, $args) {
    
    $app_route = 'http://localhost/web-services-project/clinic-api';

    $api["message"] = "Welcome to the Clinic API!";
    $api["routes"] = ['token' => "$app_route/token",
    'account' => "$app_route/account",
    'clinics' => "$app_route/clinics",
    'doctors' => "$app_route/doctors",
    'patients' => "$app_route/patients",
    'schedules' => "$app_route/schedules"];

    $response->getBody()->write(json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $response;
});

// Run the app.
$app->run();