<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_hos_management';
global $con;

$con = mysqli_connect($host, $user, $password, $dbname) or die('Failed to connect to database server');

function GetValue($sql_query){
    global $con;
    $result = mysqli_query($con, $sql_query);
    if (!$result) {
        die('Error in query: ' . mysqli_error($con));  // This will output any SQL errors
    }
    $row = mysqli_fetch_array($result);
    if (!$row) {
        return null;
    }
    return $row[0]; 
}


function isDBTableExist($dbname, $table){
	return GetValue("SELECT count(*)
		FROM information_schema.tables
		WHERE table_schema = '".$dbname."'
			AND table_name = '".$table."'
		LIMIT 1;") + 0;
}

if (!isDBTableExist($dbname, 'tblpatient')) {
    $sql = 'CREATE TABLE tblpatient (
                patientid int(10) NOT NULL AUTO_INCREMENT,
                patient_lname varchar(255) DEFAULT \'\',
				patient_fname varchar(255) DEFAULT \'\',
				patient_mname varchar(255) DEFAULT \'\',
				patient_illness	varchar(255) DEFAULT \'\',
				patient_sex	varchar(255) DEFAULT \'\',
				blood_type	varchar(255) DEFAULT \'\',
				medical_history	varchar(255) DEFAULT \'\',
				patient_dob	date NOT NULL,
				patient_height decimal(10,2) NOT NULL, 
				patient_weight decimal(10,2) NOT NULL,
				patient_province varchar(255) DEFAULT \'\',
				patient_city	varchar(255) DEFAULT \'\',
				patient_barangay	varchar(255) DEFAULT \'\',
				patient_street	varchar(255) DEFAULT \'\',
				Room_num varchar(255) NOT NULL,
				Emp_ID varchar(255) NOT NULL,
				contact_num	varchar(255) DEFAULT \'\',
				admissionDate date NOT NULL,
				insuranceDetail varchar(255) DEFAULT \'\',
				status	varchar(255) DEFAULT \'\',
                PRIMARY KEY (patientid)
            )';
    mysqli_query($con, $sql);
}
if (!isDBTableExist($dbname, 'tblroom')) {
    $sql = 'CREATE TABLE tblroom (
                Room_num int(10) NOT NULL AUTO_INCREMENT,
                Room_capacity int(20) NOT NULL,
                PRIMARY KEY (Room_num)
            )';
    mysqli_query($con, $sql);
}
if (!isDBTableExist($dbname, 'tbllogin')) {
    $sql = 'CREATE TABLE tbllogin (
                Login_ID int(10) NOT NULL,
                Emp_ID varchar(255) NOT NULL DEFAULT \'\',
				Email varchar(255) NOT NULL DEFAULT \'\', 
				Phone_num varchar(255) NOT NULL DEFAULT \'\',
				Password varchar(255) NOT NULL DEFAULT \'\',
                PRIMARY KEY (Login_ID)
            )';
    mysqli_query($con, $sql);
}
if (!isDBTableExist($dbname, 'tblemployee')) {
    $sql = 'CREATE TABLE tblemployee (
                Emp_ID int(10) NOT NULL,
                Emp_lname varchar(255) NOT NULL DEFAULT \'\',
				Emp_fname varchar(255) NOT NULL DEFAULT \'\', 
				Emp_mname varchar(255) NOT NULL DEFAULT \'\',
				Emp_gender varchar(255) NOT NULL DEFAULT \'\',
				Emp_position varchar(255) NOT NULL DEFAULT \'\',
				Emp_dob date NOT NULL,
				patient_province varchar(255) DEFAULT \'\',
				patient_city	varchar(255) DEFAULT \'\',
				patient_barangay	varchar(255) DEFAULT \'\',
				patient_street	varchar(255) DEFAULT \'\',
				Emp_cnum varchar(255) NOT NULL DEFAULT \'\',
                PRIMARY KEY (Emp_ID)
            )';
    mysqli_query($con, $sql);
}

?>
