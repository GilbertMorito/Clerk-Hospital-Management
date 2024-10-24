const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");
toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});
searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
});
modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    modeText.innerText = "Light mode";
  } else {
    modeText.innerText = "Dark mode";
  }
});

function loadPage(url, elementId){
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById(elementId).innerHTML = "";
			document.getElementById(elementId).innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function addEditPatient(patientid){
	var action = "Add";  
	if (patientid != 0){ action = "Update"; }
	
	var patient_lname = document.getElementById('patient_lname').value;
	var patient_fname = document.getElementById('patient_fname').value;
	var patient_mname = document.getElementById('patient_mname').value;
	
	if (patient_lname !== '' && patient_fname !== '' && patient_mname !== ''){
		swal({
			title: "Patient Information",
			text: "Are you sure to " + action + " this Patient Information?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willAdd) => {
			if (willAdd){
				loadPage('pages/patient.php?patientid=' + patientid +
				'&patient_lname=' + encodeURIComponent(patient_lname) +
				'&patient_fname=' + encodeURIComponent(patient_fname) +
				'&patient_mname=' + encodeURIComponent(patient_mname),
				'content');
			}
		});
	} else {
		if (patient_lname === ''){
			swal('Error on Last Name', 'Please input Last Name', 'error');
		} else if (patient_fname === ''){
			swal('Error on First Name', 'Please input First Name', 'error');
		} else if (patient_mname === ''){
			swal('Error on Middle Name', 'Please input Middle Name', 'error');
		}
	}
}
