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
		$patient_dob = GetValue('SELECT patient_dob FROM tblpatient WHERE patientid=' . (int)$patientid);
		$patient_sex = GetValue('SELECT patient_sex FROM tblpatient WHERE patientid=' . (int)$patientid);
		$contact_num = GetValue('SELECT contact_num FROM tblpatient WHERE patientid=' . (int)$patientid);

        // Check if values are null and handle them
        $patient_lname = $patient_lname === null ? '' : $patient_lname;
        $patient_fname = $patient_fname === null ? '' : $patient_fname;
        $patient_mname = $patient_mname === null ? '' : $patient_mname;
		$patient_dob = $patient_dob === null ? '' : $patient_dob;
		$patient_sex = $patient_sex === null ? '' : $patient_sex;
		$contact_num = $contact_num === null ? '' : $contact_num;
    } else {
        $patientid = 0;  // Default patientid if not provided
        $patient_lname = '';  // Default last name if no patient is found
        $patient_fname = '';  // Default first name if no patient is found
        $patient_mname = '';  // Default middle name if no patient is found
		$patient_dob = '';
		$patient_sex = '';
		$contact_num = '';
    }

    // Insert or update patient details
    if (isset($_GET['patientid']) && isset($_GET['patient_lname'])) {
        if ($_GET['patientid'] == 0) {  // Adding new patient
            mysqli_query($con, 'INSERT INTO tblpatient (patient_lname, patient_fname, patient_mname, patient_dob, patient_sex, contact_num) 
								values(\'' . urldecode($_GET['patient_lname']) . '\',
										\'' . urldecode($_GET['patient_fname']) . '\',
										\'' . urldecode($_GET['patient_mname']) . '\',
										\'' . urldecode($_GET['patient_dob']) . '\',
										\'' . urldecode($_GET['sexType']) . '\',
										\'' . urldecode($_GET['contact_num']) . '\'
										)');
        } else {	// Updating logic can go here
			mysqli_query($con, "UPDATE tblpatient SET patient_lname='" . urldecode($_GET['patient_lname']) . "',
                                            patient_fname='" . urldecode($_GET['patient_fname']) . "',
                                            patient_mname='" . urldecode($_GET['patient_mname']) . "',
                                            patient_dob='" . urldecode($_GET['patient_dob']) . "',
                                            patient_sex='" . urldecode($_GET['sexType']) . "',
                                            contact_num='" . urldecode($_GET['contact_num']) . "'
                WHERE patientid=" . $patientid);

        }
    }
?>


<style>
	.outer {
		min-height: 530px;
	}
    .container {
		width: 100%;
		max-width: 1200px;
		background-color: #fff;
		padding: 20px;
		border: 2px solid #000;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}
	.header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 20px;
	}
	.header h1 {
		font-size: 24px;
	}
	.search-bar {
		display: flex;
		gap: 10px;
		align-items: center;
	}
	.search-bar input[type="text"] {
		padding: 8px;
		border: 1px solid #000;
		border-radius: 4px;
		width: 200px;
	}
	.add-record-btn {
		padding: 8px 12px;
		border: 1px solid #000;
		border-radius: 4px;
		background-color: #77CCFF;
		color: #fff;
		cursor: pointer;
	}
	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 10px;
	}
	table, th, td {
		border: 2px solid #000;
	}
	th, td {
		padding: 10px;
		text-align: left;
		min-width: 100px;
	}
	th {
		background-color: #f4f4f4;
	}
	.view-btn {
		color: #007BFF;
		text-decoration: underline;
		cursor: pointer;
	}
</style>

<div class="outer">
	<div align="center">
		<div class="container">
			<div class="header">
				<h1>Patient Record</h1>
				<div class="search-bar">
					<input type="text" placeholder="Search">
					<button class="add-record-btn" href="javascript:void();" onclick="loadPage('pages/addpatient.php', 'content');">ADD Record</button>
				</div>
			</div>

			<table width="50%" border="1">
				<tr>
					<td>Patient ID</td>
					<td>Last Name</td>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Date of Births</td>
					<td>Sex</td>
					<td>Contact</td>
					<td>VIEW</td>
				</tr>
				<?php
				$rs = mysqli_query($con, 'SELECT * FROM tblpatient');
				while ($rw = mysqli_fetch_array($rs)) {
					echo '<tr>
							<td>' . $rw['patientid'] . '</td>
							<td>' . $rw['patient_lname'] . '</td>
							<td>' . $rw['patient_fname'] . '</td>
							<td>' . $rw['patient_mname'] . '</td>
							<td>' . $rw['patient_dob'] . '</td>
							<td>' . $rw['patient_sex'] . '</td>
							<td>' . $rw['contact_num'] . '</td>
							<td><a href="javascript:void(0);" onclick="loadPage(\'pages/patientprofile.php?patientid=' . $rw['patientid'] . '\',\'content\')">VIEW</a></td>
						</tr>';
				}
				?>
			</table>
		</div>

		<div class="form-container">
			<!-- Personal Information Section -->
			<div class="section">
				<div class="section-title">Personal Information</div>
				<form action="javascript:void(0);">
					<div class="form-group">
						<label for="patient-id">Patient ID:</label>
						<input type="text" id="patientid" name="patientid" value="<?= $patientid ?>" readonly>
					</div>
					<div class="form-group">
						<label for="last-name">Last Name:</label>
						<input type="text" id="patient_lname" name="patient_lname" value="<?= $patient_lname ?>">
					</div>
					<div class="form-group">
						<label for="first-name">First Name:</label>
						<input type="text" id="patient_fname" name="patient_fname" value="<?= $patient_fname ?>">
					</div>
					<div class="form-group">
						<label for="middle-name">Middle Name:</label>
						<input type="text" id="patient_mname" name="patient_mname" value="<?= $patient_mname ?>">
					</div>
					<div class="form-group">
						<label for="dob">Date of Birth:</label>
						<input type="date" id="patient_dob" name="patient_dob" value="<?= $patient_dob ?>">
					</div>
					<div class="form-group">
						<form method="POST">
						<label>Sex:</label>
							<input type="radio" name="patient_sex" value="Male" /> Male
							<input type="radio" name="patient_sex" value="Female" /> Female
						</form>
					</div>
					<div class="form-group">
						<label for="contact">Contact:</label>
						<input type="text" id="contact_num" name="contact_num" value="<?= $contact_num ?>">
					</div>
					<button name="save" onclick="addEditPatient(<?= $patientid ?>)">
						<?= $patientid ? 'Update' : 'Add'; ?>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

