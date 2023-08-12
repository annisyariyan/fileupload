<?php

  $Email = $FileError = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    $Email = test_input($_POST["Email"]);
    $File = $_FILES["File"];
    
    // Email validation
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
    {
      $EmailError = "Please check your email address again.";
    }
    
    // File upload validation
    $AllowedExtensions = array("jpeg", "jpg", "png");
    $FileExtension = strtolower(pathinfo($File["Name"], PATHINFO_EXTENSION));
    
    if (!in_array($FileExtension, $AllowedExtensions)) 
    {
      $FileError = "Please input a JPEG or PNG file.";
    }
    
    // If both email and file are valid, proceed with file upload
    if (empty($EmailError) && empty($FileError)) 
    {
      $TargetDirectory = "uploads/";
      $TargetFile = $TargetDirectory . basename($File["Name"]);
      
      if (move_uploaded_file($File["tmp_name"], $TargetFile)) 
      {
        echo "File uploaded successfully.";
      } else 
      {
        echo "Error uploading your file.";
      }
    }
  }
  
  function test_input($data) 
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
