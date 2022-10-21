function btnr_click()
{
  var nm = document.getElementById('t1').value;
  var em = document.getElementById('t2').value;
  var pass = document.getElementById('t3').value;
  //name validation
  if (nm == "") 
  {
    var vnm = "false";
    var x = "Name cannot be empty";
    document.getElementById("p1").innerHTML = x;
    document.getElementById("p1").style.color = "red";
    document.getElementById("t1").style.borderColor="red";
  }
  else 
  {
    var b = /^[a-zA-Z ]{2,30}$/;
    var a = b.test(nm);
    if (a == false) 
    {
      var vnm = "false";
      var x = "Please Enter Your name like (John)";
      document.getElementById("p1").innerHTML = x;
      document.getElementById("p1").style.color = "red";
      document.getElementById("t1").style.borderColor="red";
    } 
    else 
    {
      vnm = "true";
      var x = "";
      document.getElementById("p1").innerHTML = x;
      document.getElementById("t1").style.borderColor="green";
    }
  }


//email validation
  if (em == "") 
  {
    var vem = "false";
    var x = "Email cannot be empty";
    document.getElementById("p2").innerHTML = x;
    document.getElementById("p2").style.color = "red";
    document.getElementById("t2").style.borderColor="red";
  } 
  else 
  {
    var b = /^[a-z0-9]+@[a-z]+\.[a-z]+$/;
    var a = b.test(em);
    if (a == false) 
    {
      var vem = "false";
      var x = "Please Enter Valid Email";
      document.getElementById("p2").innerHTML = x;
      document.getElementById("p2").style.color = "red";
      document.getElementById("t2").style.borderColor="red";
    } 
    else 
    {
      vem = "true";
      var x = "";
      document.getElementById("p2").innerHTML = x;
      document.getElementById("t2").style.borderColor="green";
    }
  }

  //password validation
  if (pass == "") 
  {
    var vpass = "false";
    var x = "Password cannot be empty";
    document.getElementById("p3").innerHTML = x;
    document.getElementById("p3").style.color = "red";
    document.getElementById("t3").style.borderColor="red";
  } 
  else 
  {
    var re = /[0-9]/;
    var re1 = /[a-z]/;
    var re2 = /[A-Z]/;
    var re3 = /[!@#\$%\^\&*+=._-]/;
    // alert(pass.length);
    var a1 = pass.length < 6;
    var a2 = pass.length > 15;
    var a3 = re.test(pass);
    var a4 = re1.test(pass);
    var a5 = re2.test(pass);
    var a6 = re3.test(pass);
    // alert(a1);
    // alert(a2);
    // alert(a3);
    // alert(a4);
    // alert(a5);
    // alert(a6);
    if (
      a1 == false && a2 == false && a3 == true && a4 == true && a5 == true && a6 == true) 
      {
      var vpass = "true";
      var x = "";
      document.getElementById("p3").innerHTML = x;
      document.getElementById("t3").style.borderColor="green";
    } 
    else 
    {
      var vpass = "false";
      var x = "Please Enter Valid Password";
      document.getElementById("p3").innerHTML = x;
      document.getElementById("p3").style.color = "red";
      document.getElementById("t3").style.borderColor="red";
    }
  }


  //confirm password validation
  if (cpass == "") 
  {
    var vcpass = "false";
    var x = "Confirm Password cannot be empty";
    document.getElementById("p4").innerHTML = x;
    document.getElementById("p4").style.color = "red";
    document.getElementById("t4").style.borderColor="red";
  } 
  else
  {
    if(cpass == pass)
    {
      var vcpass = "true";
      var x = "";
      document.getElementById("p4").innerHTML = x;
      document.getElementById("t4").style.borderColor="green";
    }
    else
    {
      var vcpass = "false";
      var x = "Please Enter Same As Above";
      document.getElementById("p4").innerHTML = x;
      document.getElementById("p4").style.color = "red";
      document.getElementById("t4").style.borderColor="red";
    }
  }

  if (vnm == "true" && vem == "true" && vpass == "true") 
  {
    return true;
  } 
  else 
  {
    return false;
  }
}