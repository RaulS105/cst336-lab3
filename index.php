<!DOCTYPE html>
<html>
<head>
	<title>
		Sign up Page!
	</title>
	<style>
            @import url("css/styles.css");

     </style> 
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<form id= "signupForm" action="welcome.html">
		First Name: <input type="text" name="fName"><br>
		Last Name:  <input type="text" name="lName"><br>
		Gender:     <input type="radio" name="gender" value="m"> Male 
					<input type="radio" name="gender" value="f"> Female <br>

		Zip Code:   <input type="text" id="zip" name="zip"><br>
		City: 		<span id="city"></span><br>
		Latitude:  	<span id="latitude"></span> <br>
		Longitude:  <span id="longitude"></span> <br>

		State: 
		<select id="state" name="state">
			<option> Select One </option>
			<option value="ca"> California  </option>
			<option value="ny"> New York 	</option>
			<option value="tx"> Texas 		</option>
		</select><br><br>

		Select a County: <select id="county"></select> <br>

		Desired Username: <input type="text" id="username" name="username"><br>
						  <span  id="usernameError"></span><br>

		Password: <input type="password" id="password" name="password"><br>
		Password Again: <input type="password" id="passwordAgain"><br>
						<span  id="passwordAgainError"></span><br>
						<span  id="passwordLength"></span><br>
		<input class ="submit" type="submit" value="Sign Up!">

	</form>
		<script>

			var usernameAvailable = false;
			//in order to use "await" we must use async to establish it into our code!
			$("#zip").on("change", async function()
			{
				let zipCode = $("#zip").val();

				let url =  `https://cst336.herokuapp.com/projects/api/cityInfoAPI.php?zip=${zipCode}`;
				//await lets the web catch up to retrieve data!
				let response = await fetch(url);
				// converts the data stored in the response to the JSON format in order to access the values
				let data = await response.json();
				// displays the retrieved web API.
				$("#city").html(data.city);
				$("#longitude").html(data.longitude);
				$("#latitude").html(data.latitude);
			});

			$("#state").on("change", async function()
			{

				let state = $("#state").val();

				let url = `https://cst336.herokuapp.com/projects/api/countyListAPI.php?state=${state}`;

				let response = await fetch(url);

				let data = await response.json();

				console.log(data);

				for(let i = 0; i < data.length; i++)
				{
					$("#county").append(`<option> ${data[i].county} </option`);
				}
			});

			$("#username").on("change", async function()
			{
				let usernameError = $("#username").val();

				let url = `https://cst336.herokuapp.com/projects/api/usernamesAPI.php?username=${username}`;

				let response = await fetch(url);

				let data = await response.json();


				if (data.available)
				{
					$("#usernameError").html("Username available");
					$("#usernameError").css("color","green");
					usernameAvailable = true;
				}
				else
				{
					$("#usernameError").html("Username unavailable");
					$("#usernameError").css("color","red");
					usernameAvailable = false;
				}
			});

			$("#signupForm").on("submit", function(e)
			{
				//Prevents the form from being submitted by passing the event as a parameter!
				if (!isFormValid())
				{
					e.preventDefault();
				}

			});

			function isFormValid()
			{
				isValid = true;

				if(!usernameAvailable)
				{
					isValid = false;
				}
				
				if($("#username").val().length == 0)
				{
					isValid = false;
					$("#usernameError").html("Username is required");
				}

				if($("#password").val() != $("#passwordAgain").val())
				{
					
					$("#passwordAgainError").html("Passwords do not match!");
					isValid = false;
				}

				if($("#password").val().length < 6)
				{
					
					$("#passwordLength").html("Password needs to be at least 6 characters long!");
					isValid = false;
				}
				return isValid;
			}


		</script>

</body>
<footer>
            <hr>
            CST 336 Internet Programming. 2020&copy; Sanchez <br />
            <strong>Disclaimer:</strong> The information in this webpage is fictious. <br />
            It is used for academic purposes only. 
            <br>
             <a href="https://codepen.io/tedmcdo/pen/PqxKXg">Wave animation</a>
            <br /> <br />
            <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
            </div>
</footer>
</html>
