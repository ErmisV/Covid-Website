
function register_user(){

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

	function register_done(responseText){
		if(responseText == 0){
			Swal.fire({
				text:"Successfull Registration. Welcome to our app!"
			}).then(function(){
				window.location.assign("Login_form.php");
			});
		}else{
			Swal.fire({
				text:"Please change username or email. There is a user already registered with these data!"
			}).then(function(){
				window.location.reload();
			});
		}
	}
	//Here i take the values from the form
	let name =  $("input[name=name]").val();
	let email =  $("input[name=email]").val();
	let pass =  $("input[name=pass]").val();
	let repeat_pass = $("input[name=repeat_pass]").val();


	//If the two passwords are different a pop window is shown
	if(pass !== repeat_pass){
		alert("The two passwords you have given dont match!");
	}
	//If the two passwords dont fit the criteria
	else if (checker(pass) != true){
		console.log(checker(pass));
		alert("Your Password must contain at least one number, one symbol, one capital letter and be more than 8 characters in order to be accepted");
	}//If it fits the criteria
	else if(checker(pass) == true){

		//check for spaces
		if(pass.match(/\s/)){
			if(confirm("Do you want your password to have spaces?")){
				const ajax_query_spaces = $.ajax({
					url:"Registration_backend.php",
					type:"POST",
					dataType:"script",
					data:{username:name, password: pass, email:email},
					success:function(data){
						console.log(data);
					}
				});

				ajax_query_spaces.done(register_done);

				event.preventDefault();

			} else {
				alert("Registration Failed!");
				window.location.reload();
			}
		} else{
			const ajax_query = $.ajax({
				url:"Registration_backend.php",
				type:"POST",
				dataType: "script",
				data:{username:name, password: pass, email:email},
				success:function(data){
					console.log(data);
				}
			});

			ajax_query.done(register_done);

			event.preventDefault();
		}


	}




}
