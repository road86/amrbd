<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
   {
    return view('welcome');
   });

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('showprofile', 'ShowProfileController');


// Isolate Data Type Page
//Route::get('/isolatedatatype/view', 'IsolateDataTypeController@view');

Route::get('/isolatedatatype/isolatetypeview', 'IsolateDataTypeController@IsolateTypeView');
Route::get('/isolatedatatype/isolatetypeindividualview', 'IsolateDataTypeController@IsolateTypeIndividualView');

Route::get('/isolatedatatype/isolatetypesummarizeview', 'IsolateDataTypeController@IsolateTypeSummarizeView');

Route::get('/isolatedatatype/dataview', 'IsolateDataTypeController@DataView');
//Route::get('/singleisolatesample/create', 'SingleIsolateSampleController@create');


// Report view Page
Route::get('/report/view', 'ReportController@view');



//Single Isolate SIR Report create page
//Route::get('/report/sglisircreate', 'ReportController@SingleIsolateSIRspecimencreate');
//Single Isolate ZDIS Report create page
//Route::get('/report/sglizdiscreate', 'ReportController@SingleIsolateZDISspecimencreate');


//Single Isolate SIR Specimen Report Page
//Route::post('/report/specimenreport', 'ReportController@SpecimenReport');

//Route::get('/report/pdf', 'ReportController@SingleIsolateSIRPdfExport');
//Route::get('/report/pdfview', 'ReportController@PdfView');


//Individual Isolate SIR Report create page
Route::get('/report/indisirreportcreate', 'ReportController@IndIsirReportCreate');
Route::post('/report/indisirreportcalculation', 'ReportController@IndIsirReportCalculation');



//Individual Isolate ZDIS Report create page

Route::get('/report/indizdisreportcreate', 'ReportController@IndIzdisReportCreate');
Route::post('/report/indizdisreportcalculation', 'ReportController@IndIzdisReportCalculation');

//User Management
Route::get('/usermanagement/managementview', 'UsersController@ManagementView');

//User 
Route::get('/usermanagement/usersview', 'UsersController@UserView');
Route::get('/usermanagement/userscreate', 'UsersController@UserCreate');
Route::post('/usermanagement/usersstore', 'UsersController@UserStore');
Route::get('/usermanagement/edit-users-name/{id}', 'UsersController@EditUsersName');
Route::post('/usermanagement/updateuser', 'UsersController@UpdateUser');

//User Role
Route::get('/usermanagement/rolesview', 'RolesController@RolesView');
Route::get('/usermanagement/rolescreate', 'RolesController@RolesCreate');
Route::post('/usermanagement/rolesstore', 'RolesController@RolesStore');

//Role Has Permissions
Route::get('/usermanagement/role_has_permissionsview','RoleHasPermissionsController@RoleHasPermissionView');
Route::get('/usermanagement/role_has_permissionscreate','RoleHasPermissionsController@RoleHasPermissionCreate');
Route::post('/usermanagement/role_has_permissionsstore','RoleHasPermissionsController@RoleHasPermissionStore');

//User Permission
Route::get('/usermanagement/permissionsview', 'PermissionsController@PermissionsView');
Route::get('/usermanagement/permissionscreate', 'PermissionsController@PermissionsCreate');
Route::post('/usermanagement/permissionsstore', 'PermissionsController@PermissionsStore');


//Single Isolate ZDIS Specimen Report Page
//Route::post('/report/zdisspecimenreport', 'ReportController@ZdisSpecimenReport');




// Single Isolate SIR Sample CRUD
Route::get('/singleisolatesample/view', 'SingleIsolateSampleController@view');
Route::get('/singleisolatesample/create', 'SingleIsolateSampleController@create');
Route::post('/singleisolatesample/store', 'SingleIsolateSampleController@store');
Route::get('/singleisolatesample/delete-sglisample-id/{id}', 'SingleIsolateSampleController@DeleteSglISampleID');

Route::post('/singleisolatesample/createpostconfirmation', 'SingleIsolateSampleController@SglIsirSampleFormConfirmation');

Route::get('singleisolatesample/export/', 'SingleIsolateSampleController@SglISampleTableExport');

Route::get('/get-breed-by-species/{id}', 'SingleIsolateSampleController@getBreedBySpecies');



// Single Isolate SIR Test CRUD
Route::get('/singleisolatesampletest/view', 'SingleIsolateSampleTestController@view');
Route::get('/singleisolatesampletest/create/{id}', 'SingleIsolateSampleTestController@create');
Route::post('/singleisolatesampletest/store', 'SingleIsolateSampleTestController@store');
Route::get('/singleisolatesampletest/delete-sglisampletest-id/{id}', 'SingleIsolateSampleTestController@DeleteSingleISampleTestID');

Route::get('/singleisolatesampletest/export', 'SingleIsolateSampleTestController@SglISampleTestTableExport');


// Single Isolate Zone Diameter Interpretative Standards(ZDIS) Sample CRUD
Route::get('/singleisolatezdissample/view', 'SingleIsolateZdisSampleController@view');
Route::get('/singleisolatezdissample/create', 'SingleIsolateZdisSampleController@create');
Route::post('/singleisolatezdissample/store', 'SingleIsolateZdisSampleController@store');
Route::get('/singleisolatezdissample/delete-sglizdissample-id/{id}', 'SingleIsolateZdisSampleController@DeleteSingleIsolateZDISSampleID');

// Single Isolate Zone Diameter Interpretative Standards(ZDIS)Test CRUD
Route::get('/singleisolatezdissampletest/view', 'SingleIsolateZdisSampleTestController@view');
Route::get('/singleisolatezdissampletest/create/{id}', 'SingleIsolateZdisSampleTestController@create');
Route::post('/singleisolatezdissampletest/store', 'SingleIsolateZdisSampleTestController@store');
Route::get('/singleisolatezdissampletest/delete-sglisampletest-id/{id}', 'SingleIsolateZdisSampleTestController@DeleteSingleIsolateZDISSampleTestID');


// Summarize Isolate Numric Sample CRUD
Route::get('/summarizeinumsample/view', 'SummarizeIsolateNumericSampleController@view');
Route::get('/summarizeinumsample/create', 'SummarizeIsolateNumericSampleController@create');
Route::post('/summarizeinumsample/store', 'SummarizeIsolateNumericSampleController@store');
//Route::get('/summarizedinumsample/delete-sglizdissample-id/{id}', 'SingleIsolateZdisSampleController@DeleteSingleIsolateZDISSampleID');


// Summarize Isolate Numeric Test CRUD
Route::get('/summarizeinumsampletest/view', 'SummarizeIsolateNumericSampleTestController@view');
Route::get('/summarizeinumsampletest/create/{id}', 'SummarizeIsolateNumericSampleTestController@create');
Route::post('/summarizeinumsampletest/store', 'SummarizeIsolateNumericSampleTestController@store');


// Summarize Isolate Percent Sample CRUD
Route::get('/summarizeipersample/view', 'SummarizeIsolatePercentSampleController@view');
Route::get('/summarizeipersample/create', 'SummarizeIsolatePercentSampleController@create');
Route::post('/summarizeipersample/store', 'SummarizeIsolatePercentSampleController@store');
//Route::get('/summarizedinumsample/delete-sglizdissample-id/{id}', 'SingleIsolateZdisSampleController@DeleteSingleIsolateZDISSampleID');


// Summarize Isolate Percent Test CRUD
Route::get('/summarizeipersampletest/view', 'SummarizeIsolatePercentSampleTestController@view');
Route::get('/summarizeipersampletest/create/{id}', 'SummarizeIsolatePercentSampleTestController@create');
Route::post('/summarizeipersampletest/store', 'SummarizeIsolatePercentSampleTestController@store');


// Sample Type CRUD
//Route::get('/sampletype/singleisloatecreate', 'sampletypeController@singleisloatecreate');
//Route::post('/samples/store', 'SampleController@store');
//Route::get('/sampletype/create', 'sampletypeController@create');



// Samples CRUD
//Route::get('/samples/create', 'SampleController@create');
//Route::post('/samples/store', 'SampleController@store');
//Route::get('/samples/view', 'SampleController@view');
//Route::get('/get-breed-by-species/{id}', 'SampleController@getBreedBySpecies');

// Samples Test CRUD

//Route::get('/sampletest/view', 'SampleTestController@view');
//Route::get('/sampletest/create/{id}', 'SampleTestController@create');
//Route::post('/sampletests/store', 'SampleTestController@store');


// Institution CRUD

Route::get('/institution/view', 'InstitutionController@view');
Route::get('/institution/create', 'InstitutionController@create');
Route::post('/institution/store', 'InstitutionController@store');
Route::get('/institution/delete-institution-id/{id}', 'InstitutionController@DeteteInstitutionID');
Route::get('/institution/edit-institution-name/{id}', 'InstitutionController@EditInstitutionName');
Route::post('/institution/update-institution-name', 'InstitutionController@UpdateInstitutionName');

Route::get('/institution/pdf', 'InstitutionController@InstitutionPdfExport');
Route::get('/institution/pdfview', 'InstitutionController@PdfView');


// Species CRUD

Route::get('/species/view', 'SpeciesController@view');
Route::get('/species/create', 'SpeciesController@create');
Route::post('/species/store', 'SpeciesController@store');
Route::get('/species/delete-species-id/{id}', 'SpeciesController@DeteteSpeciesID');
Route::get('/species/edit-species-name/{id}', 'SpeciesController@EditSpeciesName');
Route::post('/species/update-species-name', 'SpeciesController@UpdateSpeciesName');

Route::get('/species/pdf', 'SpeciesController@SpeciesPdfExport');
Route::get('/species/pdfview', 'SpeciesController@PdfView');


// Breed CRUD
Route::get('/breed/view', 'BreedController@view');
Route::get('/breed/create', 'BreedController@create');
Route::post('/breed/store', 'BreedController@store');
Route::get('/breed/delete-breed-id/{id}', 'BreedController@DeleteBreedName');
Route::get('/breed/edit-breed-name/{id}', 'BreedController@EditBreedName');
Route::post('/breed/update-breed-name', 'BreedController@UpdateBreedName');

Route::get('/breed/pdf', 'BreedController@BreedPdfExport');
Route::get('/breed/pdfview', 'BreedController@PdfView');


// Specimen CRUD

Route::get('/specimen/view', 'SpecimenController@view');
Route::get('/specimen/create', 'SpecimenController@create');
Route::post('/specimen/store', 'SpecimenController@store');
Route::get('/specimen/delete-specimen-name/{id}', 'SpecimenController@DeleteSpecimenName');
Route::get('/specimen/edit-specimen-name/{id}', 'SpecimenController@EditSpecimenName');
Route::post('/specimen/update-specimen-name', 'SpecimenController@UpdateSpecimenName');

Route::get('/specimen/pdf', 'SpecimenController@SpecimenPdfExport');
Route::get('/specimen/pdfview', 'SpecimenController@PdfView');


//Specimen Collection Location CRUD

Route::get('/specimencollectionlocation/view', 'SpecimenCollectionLocationController@view');
Route::get('/specimencollectionlocation/create', 'SpecimenCollectionLocationController@create');
Route::post('/specimencollectionlocation/store', 'SpecimenCollectionLocationController@store');
Route::get('/specimencollectionlocation/delete-samplinglocation-name/{id}', 'SpecimenCollectionLocationController@DeleteSamplingLocationName');
Route::get('/specimencollectionlocation/edit-samplinglocation-name/{id}', 'SpecimenCollectionLocationController@EditSamplingLocationName');
Route::post('/specimencollectionlocation/update-samplinglocation-name', 'SpecimenCollectionLocationController@UpdateSamplingLocationName');

Route::get('/specimencollectionlocation/pdf', 'SpecimenCollectionLocationController@SamplingLocationPdfExport');
Route::get('/specimencollectionlocation/pdfview', 'SpecimenCollectionLocationController@PdfView');



// Pathogen CRUD

Route::get('/pathogen/view', 'PathogenController@view');
Route::get('/pathogen/create', 'PathogenController@create');
Route::post('/pathogen/store', 'PathogenController@store');
Route::get('/pathogen/delete-pathogen-name/{id}', 'PathogenController@DeletePathogenName');
Route::get('/pathogen/edit-pathogen-name/{id}', 'PathogenController@EditPathogenName');
Route::post('/pathogen/update-pathogen-name', 'PathogenController@UpdatePathogenName');

Route::get('/pathogen/pdf', 'PathogenController@PathogenPdfExport');
Route::get('/pathogen/pdfview', 'PathogenController@PdfView');


// Antibiotic CRUD

Route::get('/antibiotic/view', 'AntibioticController@view');
Route::get('/antibiotic/create', 'AntibioticController@create');
Route::post('/antibiotic/store', 'AntibioticController@store');
Route::get('/antibiotic/delete-antibiotic-name/{id}', 'AntibioticController@DeleteAntibioticName');
Route::get('/antibiotic/edit-antibiotic-name/{id}', 'AntibioticController@EditAntibioticName');
Route::post('/antibiotic/update-antibiotic-name', 'AntibioticController@UpdateAntibioticName');

Route::get('antibiotic/excel/', 'AntibioticController@AntibioticsExcelExport');


Route::get('antibiotic/pdf', 'AntibioticController@AntibioticsPDFExport');
Route::get('antibiotic/pdfview', 'AntibioticController@PdfView');


// Test Method CRUD

Route::get('/testmethod/view', 'TestMethodController@view');
Route::get('/testmethod/create', 'TestMethodController@create');
Route::post('/testmethod/store', 'TestMethodController@store');
Route::post('/testmethod/update', 'TestMethodController@update');
Route::get('/testmethod/delete-test-method/{id}', 'TestMethodController@DeleteTestMethod');
Route::get('/testmethod/edit-test-method/{id}', 'TestMethodController@EditTestMethod');

Route::get('/testmethod/pdf','TestMethodController@TestMethodPDFExport');
Route::get('/testmethod/pdfview','TestMethodController@PdfView');

// Test Sensitivity CRUD

Route::get('/testsensitivity/view', 'TestSensitivityController@view');
Route::get('/testsensitivity/create', 'TestSensitivityController@create');
Route::post('/testsensitivity/store', 'TestSensitivityController@store');
Route::get('/testsensitivity/delete-test-sensitivity-type/{id}','TestSensitivityController@DeleteTestSensitivityType');
Route::get('/testsensitivity/edit-test-sensitivity-type/{id}', 'TestSensitivityController@EditTestSensitivityType');
Route::post('/testsensitivity/update-test-sensitivity-type', 'TestSensitivityController@UpdateTestSensitivityType');

Route::get('/testsensitivity/pdf','TestSensitivityController@TestSensitivityPDFExport');
Route::get('/testsensitivity/pdfview','TestSensitivityController@PdfView');


// ZDIS Table CRUD

Route::get('/zdis/view', 'ZdisPathogenController@view');
Route::get('/zdis/create', 'ZdisPathogenController@create');
Route::post('/zdis/store', 'ZdisPathogenController@store');
Route::get('/zdis/delete-zdis-id/{id}', 'ZdisPathogenController@DeleteZdisID');
Route::get('/zdis/edit-zdis-values/{id}', 'ZdisPathogenController@EditZdisValues');
Route::post('/zdis/update-zdis-values', 'ZdisPathogenController@UpdateZdisValues');

Route::get('/zdis/pdf','ZdisPathogenController@ZdisRefTablePDFExport');
Route::get('/zdis/pdfview','ZdisPathogenController@PdfView');

Route::get('users/export/', 'UsersController@export');


    //Manage Permissions
     Route::get('/permission/manage-role', 'ManagePermissionController@role');
     Route::get('/permission/manage-permission', 'ManagePermissionController@permission');
     Route::get('/permission/assign-role-permission', 'ManagePermissionController@rolePermission');
     Route::get('/permission/user-permission', 'ManagePermissionController@userPermission');
     Route::get('/permission/user-role', 'ManagePermissionController@userRole');

     Route::get('/get-user-role/{id}', 'ManagePermissionController@selectUserRole');
     Route::get('/get-user-permission/{id}', 'ManagePermissionController@selectUserPermission');
     Route::get('/get-role-permission/{id}', 'ManagePermissionController@selectRolePermission');
     Route::get('/permission/delete-roles/{id}', 'ManagePermissionController@deleteRole');

     Route::post('/permission/save-role', 'ManagePermissionController@saveRole');
     Route::post('/permission/save-permission', 'ManagePermissionController@savePermission');     
     Route::post('/permission/assign-role', 'ManagePermissionController@saveUserRole');
     Route::post('/permission/assign-permission', 'ManagePermissionController@saveUserPermission');     
     Route::post('/permission/assign-permission-role', 'ManagePermissionController@saveRolePermission');


    //end permissions








