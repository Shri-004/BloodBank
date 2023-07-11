const form = document.getElementById('form');
const username = document.getElementById('username');
const fullname = document.getElementById('fullname');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const number = document.getElementById("number");
const age = document.getElementById("age");
var v1,v2,v3,v4,v5,v6,v0;
v0=v1=v2=v3=v4=v5=v6=0;

function checkInputs() {
	// trim to remove the whitespaces
	const usernameValue = username.value.trim();
	const fullnameValue = fullname.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
    const numberValue = number.value.trim();
    const ageValue = Number(age.value.trim());
	
	if(usernameValue === '') {
		setErrorFor(username, 'Username cannot be blank');
	} else {
		setSuccessFor(username);
		v0=1;
	}
	if(fullnameValue === '')
	{
		setErrorFor(fullname,'Fullname cannot be blank');
	}
	else
	{
		setSuccessFor(fullname);
		v1=1;
	}
    if(numberValue.length!=10)
    {
        setErrorFor(number,"Invalid Phone Number");
    }
	else if(/^[1-9]{1}[0-9]{9}$/.test(numberValue)==false)
	{
		setErrorFor(number,"Phone Number should only contain digits");
	}
    else
    {
		console.log(numberValue.match("/^[1-9]{1}[0-9]{9}$/"))
        setSuccessFor(number);
		v2=1;
    }
    if(ageValue<18 || ageValue>65)
    {
        // console.log(ageValue.length);
        setErrorFor(age,"Invalid Age");
    }
    else
    {
        setSuccessFor(age);
		v3=1;
    }
	
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
		v4=1;
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
		v5=1;
	}
	
	if(password2Value === '') {
		setErrorFor(password2, 'Password2 cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Passwords does not match');
        console.log("password doesnt match");
	} else{
		setSuccessFor(password2);
		v6=1;
	}
    if((v0==1)&&(v1==1)&&(v2==1)&&(v3==1)&&(v4==1)&&(v5==1)&&(v6==1))
    {
        console.log(v0,v1,v2,v3,v4,v5,v6);
    window.open("recipienthome.html");
    }
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
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

