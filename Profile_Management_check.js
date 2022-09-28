function checker(password){
	//Check if the pass is under 8 characters
	if(password.length<8){
		return false;
	}

	//I make the password into an array of characters
	let character = password.split("");
	let flag_1 = false;
	let flag_2 = false;
	let flag_3 = false;


	for(var i=0;i<character.length;i++){

		//Every character is matched with his ascii number
		let asc_number = character[i].charCodeAt();

		//Check if the character is a number
		if(!isNaN(character[i]) === true){
			flag_1 = true;
		}

		//Check if the character is a capital letter
		if(character[i].match(/[A-Z]/)){
			flag_3 = true;
		}

		//Check if the character is a special character
		if((asc_number >=33 && asc_number <=47) || (asc_number >=58 && asc_number <=64) || (asc_number >=91 && asc_number <=96) || (asc_number >=123 && asc_number<=126)){
			flag_2 = true;
		}

		//If the three flags are true then it passes the check we put it into
		if(flag_1 == true && flag_2 ==true && flag_3 == true){
			return true;
		}
	}

	//If something fails it return false

	return false;
}


function profile_manage(){

	event.preventDefault();

	let name =  $("input[name=user_PM]").val();
	let pass =  $("input[name=pass_PM]").val();
	let repeat_pass = $("input[name=repeat_pass_PM]").val();
	let old_pass = $("input[name=old_pass]").val();
	console.log(name);
	console.log(pass);
	console.log(repeat_pass);
	console.log(old_pass);


	if(pass !== repeat_pass){
		Swal.fire({
			text:"Passwords dont match!"
		}).then(function(){
			window.location.assign("Profile Management.php");
		});
	}else if(checker(pass) != true){
		Swal.fire({
			text:"Passwords must contain at least one number, one symbol, one capital letter and be more than 8 characters"
		}).then(function(){
			window.location.assign("Profile Management.php");
		});
	}else if(checker(pass) == true){
		if(pass.match(/\s/)){
			if(confirm("Do you want your password to have spaces?")){
				const req = $.ajax({
					url: "Profile_Management_backend.php",
					type: "POST",
					dataType: "script",
					data: {username: name, password: pass,old_password:old_pass}
				});

				req.done(profile_changed);

				event.preventDefault();
			} else {
				Swal.fire({
					text:"Change of Password Failed!"
				});
				window.location.reload();
			}
		} else{
			const req = $.ajax({
				url: "Profile_Management_backend.php",
				type: "POST",
				dataType: "script",
				data: {username: name, password: pass, old_password:old_pass}
			});

			req.done(profile_changed);

			event.preventDefault();
	}

	}
}


function profile_changed(responseText){
	if(responseText == 2){
		Swal.fire({
			text:"You typed wrong your old password"
		}).then(function(){
			window.location.assign("Profile Management.php");
		});

	}
	else if(responseText == 3){
		Swal.fire({
			text:"This username is taked"
		}).then(function(){
			window.location.assign("Profile Management.php");
		});

	}
	else{
		Swal.fire({
			text:"Successful Change of Information"
		}).then(function(){
			window.location.assign("index.php");
		});

	}

}