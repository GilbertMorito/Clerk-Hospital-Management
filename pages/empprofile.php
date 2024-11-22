<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="css/emp.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f9f9f9;
		}

		.container {
			display: flex;
			max-width: 900px;
			min-width: 700px;
			margin: 50px auto 10px auto;
			gap: 20px;
		}

		.profile-section {
			flex: 1;
			background-color: #ffffff;
			border-radius: 10px;
			padding: 20px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			text-align: center;
		}

		.profile-section img {
			width: 100px;
			height: 100px;
			border-radius: 50%;
			object-fit: cover;
			margin-bottom: 5px;
		}

		.edit-icon {
			position: absolute;
			top: 90px;
			left: 120px;
			background-color: white;
			border: 1px solid #ccc;
			border-radius: 50%;
			padding: 5px;
			cursor: pointer;
		}

		.info-section {
			flex: 2;
			background-color: #ffffff;
			border-radius: 10px;
			padding: 20px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}
		.info-section2 {
			width: 95%;
			max-width: 700px;
			background-color: #ffffff;
			border-radius: 10px;
			padding: 20px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.info-section .header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}

		.edit-button {
			background-color: #007BFF;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 5px 10px;
			cursor: pointer;
		}

		.info-section ul {
			list-style-type: none;
			padding: 0;
		}

		.info-section li {
			margin-bottom: 10px;
			font-size: 16px;
		}
		
		.info-section2 ul {
			list-style-type: none;
			padding: 0;
		}

		.info-section2 li {
			margin-bottom: 10px;
			font-size: 16px;
		}

		a {
			color: #007BFF;
			text-decoration: none;
		}

	</style>
</head>
<body>
    <div class="container">
        <!-- Left Profile Section -->
        <div class="profile-section">
            <div class="profile-image">
                <img src="img/logo.png" alt="Profile Image">
            </div>
            <h2>Dr. Morito</h2>
            <p>IT Specialist</p>
            <p>Status: <strong>Online</strong></p>
            <p>Email: <a href="#">gilbertmorito@gnail.com</a></p>
        </div>

        <!-- Right Information Section -->
        <div class="info-section">
            <div class="header">
                <h3>Basic Information</h3>
                <button class="edit-button">Edit</button>
            </div>
            <ul>
                <li><strong>First Name:</strong>Gilbert Khen</li>
                <li><strong>Last Name:</strong> Morito</li>
                <li><strong>Phone (Work):</strong> 416-564-4374</li>
                <li><strong>Employee ID:</strong> 1</li>
				<li><strong>Sex:</strong> Yes</li>
            </ul>
        </div>
    </div>
	<div class="info-section2">
		<div class="header">
                <h3>Basic Information</h3>
            </div>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
</body>
</html>
