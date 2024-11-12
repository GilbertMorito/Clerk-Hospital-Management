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
				extension_name	varchar(255) DEFAULT \'\',
				patient_sex	varchar(255) DEFAULT \'\',
				patient_dob	date NOT NULL,
				patient_bt	varchar(255) DEFAULT \'\',
				patient_height	varchar(225) DEFAULT \'\',
				patient_weight	varchar(255) DEFAULT \'\',
				contact_num	varchar(255) DEFAULT \'\',
				admission_date	date NOT NULL,
				patient_province varchar(255) DEFAULT \'\',
				patient_city	varchar(255) DEFAULT \'\',
				patient_barangay	varchar(255) DEFAULT \'\',
				patient_street	varchar(255) DEFAULT \'\',
				e1_name varchar(255) DEFAULT \'\',
				e1_rel varchar(255) DEFAULT \'\',
				e1_cnum varchar(255) DEFAULT \'\',
				e2_name varchar(255) DEFAULT \'\',
				e2_rel varchar(255) DEFAULT \'\',
				e2_cnum varchar(255) DEFAULT \'\',
				insur_carrier varchar(255) DEFAULT \'\',
				insur_plan varchar(255) DEFAULT \'\',
				insur_cnum varchar(255) DEFAULT \'\',
				insur_pnum varchar(255) DEFAULT \'\',
				insur_gnum varchar(255) DEFAULT \'\',
				insur_snum varchar(255) DEFAULT \'\',
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
                login_ID int NOT NULL AUTO_INCREMENT,
                account varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                PRIMARY KEY (login_ID)
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
