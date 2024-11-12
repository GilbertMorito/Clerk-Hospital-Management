
        <table width="100%" border="1">
            <?php
            echo '<tr>
                    <td>Patient ID</td>
                    <td>' . $patientid . '</td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" style="width:250px;" id="patient_lname" value="' . $patient_lname . '" /></td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" style="width:250px;" id="patient_fname" value="' . $patient_fname . '" /></td>
                </tr>
                <tr>
                    <td>Middle Name: </td>
                    <td><input type="text" style="width:250px;" id="patient_mname" value="' . $patient_mname . '" /></td>
                </tr>';
            ?>

            <tr>
                <td colspan="2">
                    <!-- Correctly handle the button outside of the echo -->
                    <button onclick="addEditPatient(<?= $patientid ?>, document.getElementById('patient_fname').value, document.getElementById('patient_mname').value);">
                        <?= $patientid ? 'Update' : 'Add'; ?>
                    </button>
                </td>
            </tr>
        </table>
		
//JS 

		function addEditPatient(patientid) {
    const action = patientid !== 0 ? "Update" : "Add";

    // Collect values from input fields
    const patient_lname = document.getElementById('patient_lname')?.value;
    const patient_fname = document.getElementById('patient_fname')?.value;
    const patient_mname = document.getElementById('patient_mname')?.value;
    const patient_dob = document.getElementById('patient_dob')?.value;
    const sexType = document.querySelector('input[name="sex"]:checked')?.value;
    const contact_num = document.getElementById('contact_num')?.value;

    // Check if any of the fields are null
    if (patient_lname === undefined || patient_fname === undefined || patient_mname === undefined || 
        patient_dob === undefined || sexType === undefined || contact_num === undefined) {
        console.error("One or more fields are not found in the DOM.");
        return;
    }

    if (patient_lname && patient_fname && patient_mname && patient_dob && sexType && contact_num) {
        swal({
            title: "Patient Information",
            text: "Are you sure you want to " + action + " this patient’s information?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willSave) => {
            if (willSave) {
                loadPage('pages/patient.php?patientid=' + patientid +
                    '&patient_lname=' + encodeURIComponent(patient_lname) +
                    '&patient_fname=' + encodeURIComponent(patient_fname) +
                    '&patient_mname=' + encodeURIComponent(patient_mname) +
                    '&patient_dob=' + encodeURIComponent(patient_dob) +
                    '&sexType=' + encodeURIComponent(sexType) +
                    '&contact_num=' + encodeURIComponent(contact_num), 'content');
            }
        });
    } else {
        // Display error if fields are missing
        if (!patient_lname) swal('Error on Last Name', 'Please input Last Name', 'error');
        else if (!patient_fname) swal('Error on First Name', 'Please input First Name', 'error');
        else if (!patient_mname) swal('Error on Middle Name', 'Please input Middle Name', 'error');
        else if (!patient_dob) swal('Error on Date of Birth', 'Please input Date of Birth', 'error');
        else if (!sexType) swal('Error on Sex', 'Please select Sex', 'error');
        else if (!contact_num) swal('Error on Contact Number', 'Please input Contact Number', 'error');
    }
}

//Patient Php code

<?php
    // Include database connection
    if (file_exists('includes/database.php')) {
        include_once('includes/database.php');
    } elseif (file_exists('../includes/database.php')) {
        include_once('../includes/database.php');
    }

    // Initialize variables
    $patientid = 0;
    $patient_lname = '';
    $patient_fname = '';
    $patient_mname = '';
    $patient_dob = '';
    $patient_sex = '';
    $contact_num = '';

    // Check if patientid is set to retrieve data
    if (isset($_GET['patientid']) && $_GET['patientid'] != 0) {
        $patientid = (int)$_GET['patientid'];

        // Fetch existing patient data
        $query = "SELECT * FROM tblpatient WHERE patientid = $patientid";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $patient_lname = $row['patient_lname'];
            $patient_fname = $row['patient_fname'];
            $patient_mname = $row['patient_mname'];
            $patient_dob = $row['patient_dob'];
            $patient_sex = $row['patient_sex'];
            $contact_num = $row['contact_num'];
        }
    }

    // Insert or update patient details based on patientid
    if (isset($_GET['patient_lname'])) {
        $patient_lname = mysqli_real_escape_string($con, urldecode($_GET['patient_lname']));
        $patient_fname = mysqli_real_escape_string($con, urldecode($_GET['patient_fname']));
        $patient_mname = mysqli_real_escape_string($con, urldecode($_GET['patient_mname']));
        $patient_dob = mysqli_real_escape_string($con, urldecode($_GET['patient_dob']));
        $patient_sex = mysqli_real_escape_string($con, urldecode($_GET['patient_sex']));
        $contact_num = mysqli_real_escape_string($con, urldecode($_GET['contact_num']));

        if ($patientid == 0) {
            // Add new patient
            $query = "INSERT INTO tblpatient (patient_lname, patient_fname, patient_mname, patient_dob, patient_sex, contact_num)
                      VALUES ('$patient_lname', '$patient_fname', '$patient_mname', '$patient_dob', '$patient_sex', '$contact_num')";
        } else {
            // Update existing patient
            $query = "UPDATE tblpatient SET 
                      patient_lname='$patient_lname', patient_fname='$patient_fname', patient_mname='$patient_mname', 
                      patient_dob='$patient_dob', patient_sex='$patient_sex', contact_num='$contact_num'
                      WHERE patientid=$patientid";
        }
        
        if (mysqli_query($con, $query)) {
            echo "<script>swal('Success', 'Patient record updated successfully!', 'success');</script>";
        } else {
            echo "<script>swal('Error', 'Failed to update record: " . mysqli_error($con) . "', 'error');</script>";
        }
    }
?>


--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<?php
    if (file_exists('includes/database.php')) {
        include_once('includes/database.php');
    }
    if (file_exists('../includes/database.php')) {
        include_once('../includes/database.php');
    }

    // Check if patientid is set
    if (isset($_GET['patientid'])) {
        $patientid = $_GET['patientid'];

        // Get the patient details (handle null values properly)
        $patient_lname = GetValue('SELECT patient_lname FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_fname = GetValue('SELECT patient_fname FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_mname = GetValue('SELECT patient_mname FROM tblpatient WHERE patientid=' . (int)$patientid);
        $extension_name = GetValue('SELECT extension_name FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_sex = GetValue('SELECT patient_sex FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_dob = GetValue('SELECT patient_dob FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_bt = GetValue('SELECT patient_bt FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_height = GetValue('SELECT patient_height FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_weight = GetValue('SELECT patient_weight FROM tblpatient WHERE patientid=' . (int)$patientid);
        $contact_num = GetValue('SELECT contact_num FROM tblpatient WHERE patientid=' . (int)$patientid);
        $admission_date = GetValue('SELECT admission_date FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_province = GetValue('SELECT patient_province FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_city = GetValue('SELECT patient_city FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_barangay = GetValue('SELECT patient_barangay FROM tblpatient WHERE patientid=' . (int)$patientid);
        $patient_street = GetValue('SELECT patient_street FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e1_name = GetValue('SELECT e1_name FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e1_rel = GetValue('SELECT e1_rel FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e1_cnum = GetValue('SELECT e1_cnum FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e2_name = GetValue('SELECT e2_name FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e2_rel = GetValue('SELECT e2_rel FROM tblpatient WHERE patientid=' . (int)$patientid);
        $e2_cnum = GetValue('SELECT e2_cnum FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_carrier = GetValue('SELECT insur_carrier FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_plan = GetValue('SELECT insur_plan FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_cnum = GetValue('SELECT insur_cnum FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_pnum = GetValue('SELECT insur_pnum FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_gnum = GetValue('SELECT insur_gnum FROM tblpatient WHERE patientid=' . (int)$patientid);
        $insur_snum = GetValue('SELECT insur_snum FROM tblpatient WHERE patientid=' . (int)$patientid);

        // Check if values are null and handle them
        $patient_lname = $patient_lname === null ? '' : $patient_lname;
        $patient_fname = $patient_fname === null ? '' : $patient_fname;
        $patient_mname = $patient_mname === null ? '' : $patient_mname;
        $extension_name = $extension_name === null ? '' : $extension_name;
        $patient_sex = $patient_sex === null ? '' : $patient_sex;
        $patient_dob = $patient_dob === null ? '' : $patient_dob;
        $patient_bt = $patient_bt === null ? '' : $patient_bt;
        $patient_height = $patient_height === null ? '' : $patient_height;
        $patient_weight = $patient_weight === null ? '' : $patient_weight;
        $contact_num = $contact_num === null ? '' : $contact_num;
        $admission_date = $admission_date === null ? '' : $admission_date;
        $patient_province = $patient_province === null ? '' : $patient_province;
        $patient_city = $patient_city === null ? '' : $patient_city;
        $patient_barangay = $patient_barangay === null ? '' : $patient_barangay;
        $patient_street = $patient_street === null ? '' : $patient_street;
        $e1_name = $e1_name === null ? '' : $e1_name;
        $e1_rel = $e1_rel === null ? '' : $e1_rel;
        $e1_cnum = $e1_cnum === null ? '' : $e1_cnum;
        $e2_name = $e2_name === null ? '' : $e2_name;
        $e2_rel = $e2_rel === null ? '' : $e2_rel;
        $e2_cnum = $e2_cnum === null ? '' : $e2_cnum;
        $insur_carrier = $insur_carrier === null ? '' : $insur_carrier;
        $insur_plan = $insur_plan === null ? '' : $insur_plan;
        $insur_cnum = $insur_cnum === null ? '' : $insur_cnum;
        $insur_pnum = $insur_pnum === null ? '' : $insur_pnum;
        $insur_gnum = $insur_gnum === null ? '' : $insur_gnum;
        $insur_snum = $insur_snum === null ? '' : $insur_snum;

    } else {
        // Default values if no patientid is provided
        $patientid = 0;
        $patient_lname = '';
        $patient_fname = '';
        $patient_mname = '';
        $extension_name = '';
        $patient_sex = '';
        $patient_dob = '';
        $patient_bt = '';
        $patient_height = '';
        $patient_weight = '';
        $contact_num = '';
        $admission_date = '';
        $patient_province = '';
        $patient_city = '';
        $patient_barangay = '';
        $patient_street = '';
        $e1_name = '';
        $e1_rel = '';
        $e1_cnum = '';
        $e2_name = '';
        $e2_rel = '';
        $e2_cnum = '';
        $insur_carrier = '';
        $insur_plan = '';
        $insur_cnum = '';
        $insur_pnum = '';
        $insur_gnum = '';
        $insur_snum = '';
    }

    // Insert or update patient details
    if (isset($_GET['patientid']) && isset($_GET['patient_lname'])) {
        if ($_GET['patientid'] == 0) {  // Adding new patient
            mysqli_query($con, "INSERT INTO tblpatient (patient_lname, patient_fname, patient_mname, patient_dob, patient_sex, contact_num) 
                                VALUES ('" . urldecode($_GET['patient_lname']) . "',
                                        '" . urldecode($_GET['patient_fname']) . "',
                                        '" . urldecode($_GET['patient_mname']) . "',
                                        '" . urldecode($_GET['patient_dob']) . "',
                                        '" . urldecode($_GET['sexType']) . "',
                                        '" . urldecode($_GET['contact_num']) . "'
                                        )");
        } else {    // Updating patient information
            mysqli_query($con, "UPDATE tblpatient SET 
                                    patient_lname='" . urldecode($_GET['patient_lname']) . "',
                                    patient_fname='" . urldecode($_GET['patient_fname']) . "',
                                    patient_mname='" . urldecode($_GET['patient_mname']) . "',
                                    patient_dob='" . urldecode($_GET['patient_dob']) . "',
                                    patient_sex='" . urldecode($_GET['sexType']) . "',
                                    contact_num='" . urldecode($_GET['contact_num']) . "'
                                WHERE patientid=" . $patientid);
        }
    }
?>