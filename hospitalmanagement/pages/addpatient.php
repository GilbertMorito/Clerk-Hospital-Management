<?php
    if (file_exists('includes/database.php')) {
        include_once('includes/database.php');
    }
    if (file_exists('../includes/database.php')) {
        include_once('../includes/database.php');
    }

    // Define patient data fields
    $patientFields = [
        'patient_lname', 'patient_fname', 'patient_mname', 'extension_name', 
        'patient_sex', 'patient_dob', 'patient_bt', 'patient_height', 
        'patient_weight', 'contact_num', 'admission_date', 'patient_province', 
        'patient_city', 'patient_barangay', 'patient_street', 'e1_name', 
        'e1_rel', 'e1_cnum', 'e2_name', 'e2_rel', 'e2_cnum', 'insur_carrier', 
        'insur_plan', 'insur_cnum', 'insur_pnum', 'insur_gnum', 'insur_snum'
    ];

    // Initialize patient data array with default values
    $patientData = array_fill_keys($patientFields, '');

    // Check if patientid is set
    $patientid = isset($_GET['patientid']) ? (int)$_GET['patientid'] : 0;

    // Fetch patient details if patientid is provided
    if ($patientid > 0) {
        foreach ($patientFields as $field) {
            $patientData[$field] = GetValue("SELECT $field FROM tblpatient WHERE patientid=$patientid") ?? '';
        }
    }

    // Process input data from GET request, overriding default values
    foreach ($patientFields as $field) {
        if (isset($_GET[$field])) {
            $patientData[$field] = urldecode($_GET[$field]);
        }
    }

    function escape_input($con, $data) {
        foreach ($data as $key => $value) {
            $data[$key] = mysqli_real_escape_string($con, $value);
        }
        return $data;
    }

    // Only insert or update patient details when the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Escape the values for database insertion/updating
        $escapedData = escape_input($con, $patientData);

        // Insert or update patient details
        if ($patientid == 0) {  // Adding new patient
            $columns = implode(", ", array_keys($escapedData));
            $values = implode("', '", $escapedData);
            $query = "INSERT INTO tblpatient ($columns) VALUES ('$values')";
        } else {  // Updating existing patient
            $updateFields = [];
            foreach ($escapedData as $field => $value) {
                $updateFields[] = "$field='$value'";
            }
            $updateString = implode(", ", $updateFields);
            $query = "UPDATE tblpatient SET $updateString WHERE patientid=$patientid";
        }

        // Execute the query
        mysqli_query($con, $query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .container {
            width: 100%;
            max-width: 1300px;
            background-color: #fff;
            padding: 20px;
            border: 2px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            background-color: #e9ecef;
            padding: 8px;
            margin: 0;
            font-size: 16px;
            color: #2c3e50;
            font-weight: bold;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 10px 0;
        }

        .grid div {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="date"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-section {
            text-align: right;
            margin-top: -10px;
        }

        button[type="submit"] {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="container">
            <h2>Personal Health Record</h2>

            <div class="section">
                <h3>Patient Information</h3>
                <div class="grid">
                    <div>
                        <label>Patient ID</label>
                        <input type="text" value="<?= $patientid ?>" readonly>
                    </div>
                    <div>
                        <label>First name</label>
                        <input type="text" id="patient_fname" name="patient_fname" value="<?= htmlspecialchars($patientData['patient_fname']) ?>" readonly>
                    </div>
					<div>
						<label>Last name</label>
						<input type="text" id="patient_lname" name="patient_lname" value="<?= htmlspecialchars($patientData['patient_lname']) ?>">
					</div>
					<div>
						<label>Middle name</label>
						<input type="text" id="patient_mname" name="patient_mname" value="<?= htmlspecialchars($patientData['patient_mname']) ?>">
					</div>
					<div>
						<label>Extension name</label>
						<input type="text" id="extension_name" name="extension_name" value="<?= htmlspecialchars($patientData['extension_name']) ?>">
					</div>
					<div>
						<label>Gender</label>
						<input type="text" id="patient_sex" name="patient_sex" value="<?= htmlspecialchars($patientData['patient_sex']) ?>">
					</div>
					<div>
						<label>Date of birth</label>
						<input type="date" id="patient_dob" name="patient_dob" value="<?= htmlspecialchars($patientData['patient_dob']) ?>">
					</div>
					<div>
						<label>Blood type</label>
						<input type="text" id="patient_bt" name="patient_bt" value="<?= htmlspecialchars($patientData['patient_bt']) ?>">
					</div>
					<div>
						<label>Height (cm)</label>
						<input type="text" id="patient_height" name="patient_height" value="<?= htmlspecialchars($patientData['patient_height']) ?>">
					</div>
					<div>
						<label>Weight (kg)</label>
						<input type="text" id="patient_weight" name="patient_weight" value="<?= htmlspecialchars($patientData['patient_weight']) ?>">
					</div>
					<div>
						<label>Contact No.</label>
						<input type="text" id="contact_num" name="contact_num" value="<?= htmlspecialchars($patientData['contact_num']) ?>">
					</div>
					<div>
						<label>Admission date</label>
						<input type="date" id="admission_date" name="admission_date" value="<?= htmlspecialchars($patientData['admission_date']) ?>">
					</div>
					<div>
						<label>Province</label>
						<input type="text" id="patient_province" name="patient_province" value="<?= htmlspecialchars($patientData['patient_province']) ?>">
					</div>
					<div>
						<label>City</label>
						<input type="text" id="patient_city" name="patient_city" value="<?= htmlspecialchars($patientData['patient_city']) ?>">
					</div>
					<div>
						<label>Barangay</label>
						<input type="text" id="patient_barangay" name="patient_barangay" value="<?= htmlspecialchars($patientData['patient_barangay']) ?>">
					</div>
					<div>
						<label>Street</label>
						<input type="text" id="patient_street" name="patient_street" value="<?= htmlspecialchars($patientData['patient_street']) ?>">
					</div>
                </div>
            </div>

            <div class="section">
				<h3>Emergency Contact</h3>
				<div class="grid">
					<div>
						<label>Full name</label>
						<input type="text" id="e1_name" name="e1_name" value="<?= htmlspecialchars($patientData['e1_name']) ?>">
					</div>
					<div>
						<label>Relationship</label>
						<input type="text" id="e1_rel" name="e1_rel" value="<?= htmlspecialchars($patientData['e1_rel']) ?>">
					</div>
					<div>
						<label>Contact number</label>
						<input type="text" id="e1_cnum" name="e1_cnum" value="<?= htmlspecialchars($patientData['e1_cnum']) ?>">
					</div>
					<br>
					<div>
						<label>Full name</label>
						<input type="text" id="e2_name" name="e2_name" value="<?= htmlspecialchars($patientData['e2_name']) ?>">
					</div>
					<div>
						<label>Relationship</label>
						<input type="text" id="e2_rel" name="e2_rel" value="<?= htmlspecialchars($patientData['e2_rel']) ?>">
					</div>
					<div>
						<label>Contact number</label>
						<input type="text" id="e2_cnum" name="e2_cnum" value="<?= htmlspecialchars($patientData['e2_cnum']) ?>">
					</div>
				</div>
			</div>

			<div class="section">
				<h3>Insurance Information</h3>
				<div class="grid">
					<div>
						<label>Insurance carrier</label>
						<input type="text" id="insur_carrier" name="insur_carrier" value="<?= htmlspecialchars($patientData['insur_carrier']) ?>">
					</div>
					<div>
						<label>Insurance plan</label>
						<input type="text" id="insur_plan" name="insur_plan" value="<?= htmlspecialchars($patientData['insur_plan']) ?>">
					</div>
					<div>
						<label>Contact number</label>
						<input type="text" id="insur_cnum" name="insur_cnum" value="<?= htmlspecialchars($patientData['insur_cnum']) ?>">
					</div>
					<div>
						<label>Policy number</label>
						<input type="text" id="insur_pnum" name="insur_pnum" value="<?= htmlspecialchars($patientData['insur_pnum']) ?>">
					</div>
					<div>
						<label>Group number</label>
						<input type="text" id="insur_gnum" name="insur_gnum" value="<?= htmlspecialchars($patientData['insur_gnum']) ?>">
					</div>
					<div>
						<label>Social security number</label>
						<input type="text" id="insur_snum" name="insur_snum" value="<?= htmlspecialchars($patientData['insur_snum']) ?>">
					</div>
				</div>
			</div>

            <div class="submit-section">
                <button type="submit" name="submit">Add/Update Patient</button>
            </div>
        </div>
    </form>
</body>
</html>
