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

        // Check if values are null and handle them
        $patient_lname = $patient_lname === null ? '' : $patient_lname;
        $patient_fname = $patient_fname === null ? '' : $patient_fname;
        $patient_mname = $patient_mname === null ? '' : $patient_mname;
    } else {
        $patientid = 0;  // Default patientid if not provided
        $patient_lname = '';  // Default last name if no patient is found
        $patient_fname = '';  // Default first name if no patient is found
        $patient_mname = '';  // Default middle name if no patient is found
    }

    // Insert or update patient details
    if (isset($_GET['patientid']) && isset($_GET['patient_lname'])) {
        if ($_GET['patientid'] == 0) {  // Adding new patient
            mysqli_query($con, 'INSERT INTO tblpatient SET patient_lname=\'' . urldecode($_GET['patient_lname']) . '\'');
			mysqli_query($con, 'INSERT INTO tblpatient SET patient_fname=\'' . urldecode($_GET['patient_fname']) . '\'');
			mysqli_query($con, 'INSERT INTO tblpatient SET patient_mname=\'' . urldecode($_GET['patient_mname']) . '\'');
        } else {	// Updating logic can go here
			mysqli_query($con, 'UPDATE tblpatient SET patient_lname=\'' . urldecode($_GET['patient_lname']) . '\'
								WHERE patientid='.$patientid);
			mysqli_query($con, 'UPDATE tblpatient SET patient_fname=\'' . urldecode($_GET['patient_fname']) . '\'
								WHERE patientid='.$patientid);
			mysqli_query($con, 'UPDATE tblpatient SET patient_mname=\'' . urldecode($_GET['patient_mname']) . '\'
								WHERE patientid='.$patientid);
        }
    }
?>



<div align="center">
    <h3>Patient Input Record</h3>

    <div>
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

        &nbsp;

        <table width="50%" border="1">
            <tr>
                <td>Patient ID</td>
                <td>Last Name</td>
                <td>First Name</td>
                <td>Middle Name</td>
                <td>EDIT</td>
            </tr>
            <?php
            $rs = mysqli_query($con, 'SELECT * FROM tblpatient');
            while ($rw = mysqli_fetch_array($rs)) {
                echo '<tr>
                        <td>' . $rw['patientid'] . '</td>
                        <td>' . $rw['patient_lname'] . '</td>
                        <td>' . $rw['patient_fname'] . '</td>
                        <td>' . $rw['patient_mname'] . '</td>
                        <td><a href="javascript:void(0);" onclick="loadPage(\'pages/patient.php?patientid=' . $rw['patientid'] . '\',\'content\')">EDIT</a></td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</div>
