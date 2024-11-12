const body = document.querySelector("body"),
    sidebar = body.querySelector("nav"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

// Toggle sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

// Show sidebar on search
searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
});

// Toggle dark mode
modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    modeText.innerText = body.classList.contains("dark") ? "Light mode" : "Dark mode";
});

// Load a page via AJAX
function loadPage(url, elementId){
	if(window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 &&  xmlhttp.status==200){
			document.getElementById(elementId).innerHTML="";
			document.getElementById(elementId).innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function addEditPatient(patientid) {
    const action = patientid !== 0 ? "Update" : "Add";

    // Collect values from input fields
    const patient_lname = document.getElementById('patient_lname').value;
    const patient_fname = document.getElementById('patient_fname').value;
    const patient_mname = document.getElementById('patient_mname').value;
    const patient_dob = document.getElementById('patient_dob').value;
    const patient_sex = document.querySelector('input[name="patient_sex"]:checked').value;
    const contact_num = document.getElementById('contact_num').value;

    if (patient_lname && patient_fname && patient_mname && patient_dob && patient_sex && contact_num) {
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
                    '&sexType=' + encodeURIComponent(patient_sex) +
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