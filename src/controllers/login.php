<?php
  
  session_start();
  $exception = null;
  
  loadModel('Login');

  if(count($_POST)){
    $login = new Login(['email'=>$_POST['email'],'password'=>$_POST['password']]);
    try {
      $user = $login->checkLogin();
      $_SESSION['user'] = $user;
      header('location: day_records.php');
    } catch (AppException $th) {
      $_SESSION['error'] = $th->message;
      $exception = $th;
    }
  }

  loadView('login',$_POST + ['exception' => $exception]); //, 'errors' => $errors