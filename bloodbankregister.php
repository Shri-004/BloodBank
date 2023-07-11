<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Register</title>
    <link rel="stylesheet" type="text/css" href="donorregister.css">
</head>
<body>
    <div class="container">
        <div class="header" >
            <h2>Become a BloodBank</h2>
        </div>
        <form id="form" class="form" method="post"action="upload.php" enctype="multipart/form-data">
            <div class="form-control">
                <label for="bbname">Blood Bank Name</label>
                <input type="text" placeholder="Aravindan hospitals blood bank" id="bbname" name="bbname" />
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="bbusername">Username of Blood bank</label>
                <input type="text" placeholder="aravindan" name="bbusername"id="bbusername" />
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="bbpassword">Password</label>
                <input type="text" placeholder="a@avindan" name="bbpassword"id="bbpassword" />
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="bbpassword-2">Confirm Password</label>
                <input type="text" placeholder="a@avindan" id="bbpassword2" />
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="file">Lisense Upload</label>
                <input type="file" id="fileToUpload" name="fileToUpload" />
                <small>Error message</small>
            </div><br>
            <input type="button" value="Validate" onclick="checkInputs()">
            <button type="submit">Submit</button>
        </form> 
    </div> 
    <script>
        const form = document.getElementById('form');
        const name = document.getElementById("bbname");
        const username = document.getElementById('bbusername');
        const password = document.getElementById('bbpassword');
        const password2 = document.getElementById('bbpassword2');
        const file = document.getElementById("fileToUpload")
        // console.log(name,username,password,password2,bbfile);
        var v0,v1,v2,v3,v4,v5;
        v0=v1=v2=v3=v4=v5=0;

function checkInputs() {
	// trim to remove the whitespaces
	const usernameValue = username.value.trim();
	const nameValue = name.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
    const fileValue = file.value;
    console.log("the file vaue is "+fileValue);
	
	if(usernameValue === '') {
		setErrorFor(username, 'Username cannot be blank');
	} else {
		setSuccessFor(username);
		v0=1;
	}
	if(nameValue === '')
	{
		setErrorFor(name,'name cannot be blank');
	}
	else
	{
		setSuccessFor(name);
		v1=1;
	}
    
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	}
	else if( /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/.test(passwordValue)==false) 
	{
		setErrorFor(password,'Password Should Contain 7-15 Characters with atleast 1 digit and 1 special character');
	}
	else {
		setSuccessFor(password);
		v2=1;
	}
	
	if(password2Value === '') {
		setErrorFor(password2, 'Password2 cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Passwords does not match');
	} else{
		setSuccessFor(password2);
		v3=1;
	}
    if(fileValue == "") {
		setErrorFor(file, 'Username cannot be blank');
	} else {
		setSuccessFor(file);
		v4=1;
	}
	console.log(v0,v1,v2,v3,v4);
	if((v0==1)&&(v1==1)&&(v2==1)&&(v3==1)&&(v4==1))
	{
		// console.log("condition passed");
        // window.open("upload.php");
	}

}

function setErrorFor(input, message) {
	console.log(message);
	const formControl = input.parentElement;
	console.log(formControl);
	const small = formControl.querySelector('small');
	console.log(small);
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/.test(email);
}


    </script>
</body>
</html>