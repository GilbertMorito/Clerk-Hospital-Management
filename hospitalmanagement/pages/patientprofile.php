<style>
.container {
	width: 60%;
	margin: 20px auto;
	border: 1px solid #ddd;
	padding: 20px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.header, .section-title {
	background-color: #004080;
	color: #fff;
	padding: 10px;
	font-size: 18px;
	text-align: left;
}
.clinic-info, .patient-info, .treatment-info, .total-info {
	display: flex;
	justify-content: space-between;
	padding: 10px 0;
	border-bottom: 1px solid #ddd;
}
.clinic-info p, .patient-info p, .treatment-info p, .total-info p {
	margin: 0;
	padding: 5px;
	min-width: 225px;
}
.clinic-info p {
	font-weight: bold;
}
.btn-container {
	text-align: right;
	margin-top: 20px;
}
.btn {
	padding: 10px 20px;
	color: #fff;
	border: none;
	cursor: pointer;
	font-size: 16px;
}
.btn-complete {
	background-color: #007bff;
	margin-right: 10px;
}
.btn-cancel {
	background-color: #dc3545;
}
.layer{
	display: flex;
}
.layer p{
	margin: 10px  5px;
}
</style>

<div class="container">
    <div class="header">MR PATRICK MVUMA CLINIC</div>
    <div class="clinic-info">
        <p>Phone: +000-000-000-000</p>
        <p>Email: info@patrickmvuma.com</p>
        <p>Thursday 4th of March 2021</p>
    </div>

    <div class="section-title">PATIENT INFORMATION</div>
    <div class="patient-info">
        <div style="display: block;">
			<div class="layer">
				<p><strong>Full Name:</strong> Mr John Smith</p>
				<p><strong>Date of Birth:</strong> 1988-06-23</p>
				<p><strong>Gender:</strong> Male</p>
			</div>
			<div class="layer">
				<p><strong>Bloot Type:</strong></p>
				<p><strong>Height(cm):</strong></p>
				<p><strong>Weight(kg):</strong></p>
			</div>
			<div class="layer">
				<p><strong>Contact No:</strong></p>
				<p><strong>Admission Date:</strong></p>
				<p><strong>Province:</strong></p>
			</div>
			<div class="layer">
				<p><strong>City:</strong></p>
				<p><strong>Barangay:</strong></p>
				<p><strong>Street:</strong></p>
			</div>
		</div>
    </div>

    <div class="section-title">Insurance Information</div>
    <div class="treatment-info">
        <div>
            <p><strong>Cost</strong></p>
            <p>4 x MK7.5 = MK50</p>
            <p>4 x MK7.5 = MK50</p>
        </div>
        <div>
            <p><strong>Prescription</strong></p>
            <p>Paracetamol (500mg) 1 (Tablet) (OD) 2 days</p>
            <p>La (500mg) 1 (Tablet) (OD) 2 days</p>
        </div>
    </div>

    <div class="total-info">
        <p><strong>Total:</strong> MK100</p>
        <p><strong>Comment:</strong> Sample Comment</p>
    </div>

    <div class="btn-container">
        <button class="btn btn-complete">Complete Payment</button>
        <button class="btn btn-cancel">Cancel</button>
    </div>
</div>