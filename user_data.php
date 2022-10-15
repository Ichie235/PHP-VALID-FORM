<?php
 // define variables and set to empty values.
 $nameErr = $emailErr= $countryErr= $genderErr =$birthdayErr="";
 $name = $email = $country = $birthday =$gender = "";

 if($_SERVER['REQUEST_METHOD']=="POST"){
    //handle errors if input field id empty
    if(empty($_POST['name'])){
      $nameErr = "Name is required";
    }else{
      $name = test_input($_POST['name']);
      // check if name only contains letters and whitespace
      if(!preg_match("/^[a-zA-Z-']*$/",$name)){
        $nameErr = "Only letters and white space allowed";
      }
    }
      
    if(empty($_POST['email'])){
      $emailErr = "email is required";
    }else{
      $email = test_input($_POST['email']);
       //check if e-mail address is well-formed
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $emailErr ="Invaild email format";
      }
    }

    if(empty($_POST['country'])){
        $countryErr = " ";
         }else{
            $country = test_input($_POST['country']);
      }
         // get birthday from  form input
   if(empty($_POST['birthday'])){
    $birthdayErr= " ";
    }else{
     $birthday = test_input($_POST['birthday']);
}
   
    if(empty($_POST['gender'])){
      $genderErr = "gender is required";
     }else{
      $gender = test_input($_POST['gender']);
     }
     ////////////////////////////////
     if($nameErr==""&&$genderErr==""&&$countryErr==""){
      //open file 
      $file_name = fopen("userdata.csv","a");
      $no_rows = count(file("userdata.csv"));
      // append serial number to the userdata.csv file
      if($no_rows > 1){
          $no_rows = ($no_rows-1) + 1 ;
      }
      $form_data = array(
          "serial_no" => $no_rows,
          "name" => $name,
          "email"=> $email,
          "birthday"=> $birthday,
          "gender"=> $gender,
          "country"=> $country
      );
      fputcsv($file_name,$form_data);
      $name="";
      $email="";
      $gender="";
      $country="";
      $birthday="";


   }
  }

  function test_input($data){
    // use trim function  to strip unnecessary characters(extra space,tab,newline)from user input
    $data = trim($data);
    // use the stripslashes function to remove any backslashes in the input area
    $data = stripslashes($data);
    // use htmlspecialcharacter function to convert special charachters to html entities
    $data = htmlspecialchars($data);
    return $data;
  }
  print_r("Name: ".$_POST['name']."<br>");
  print_r("Email: ".$_POST['email']."<br>");
  print_r("Gender: ".$_POST['gender']."<br>");
   print_r("Birthday: ".$_POST['birthday']);

  ?>

  
