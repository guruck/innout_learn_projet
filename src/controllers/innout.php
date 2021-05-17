<?php
  session_start();
  sessionIsValid();

  // $date = (new Datetime())->getTimestamp();
  
  $user = $_SESSION['user'];
  $userWw = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
  try {
    $currentTime = strftime('%H:%M:%S',time());

    if(isset($_POST['forcedTime'])){
      $currentTime = $_POST['forcedTime'];
    }

    $userWw->innout($currentTime);
    addSuccessMsg('Ponto inserido com sucesso!');
  } catch (AppException $e) {
    addErrorMsg($e->getMessage());
  }
  header('Location: day_records.php');
