function Login() {

  function login_done(responseText) {
    if (responseText == "user") {
      Swal.fire({
        text:"Welcome to our app",
        showConfirmButton:false,
        timer: 1000
      }).then(function(){
        window.location.assign("index.php");
      });
    } else if (responseText == "admin") {
      Swal.fire({
        text:"Welcome to our app",
        showConfirmButton:false,
        timer: 1000
      }).then(function(){
        window.location.assign("index_admin.php");
      });
    } else if (responseText == "wrong pass") {
      Swal.fire({
        text:"Wrong password. Type the right one"
      }).then(function(){
        window.location.assign("Login_form.php");
      });
    } else if (responseText == "no user"){
      Swal.fire({
        text:"No User found! You must Register first dude!!!"
      }).then(function(){
        window.location.assign("Login_form.php");
      });
    }
  }

  //I take the data from the form
  let name = $("input[name=name]").val();
  let pass = $("input[name=pass]").val();

  //I send the data to php
  const ajax_query = $.ajax({
    url: "Login_backend.php",
    type: "POST",
    dataType: "text",
    data: {username: name,password: pass},
    success:function(data){
      console.log(data);
    }
  });

  ajax_query.done(login_done);


  event.preventDefault();


}
