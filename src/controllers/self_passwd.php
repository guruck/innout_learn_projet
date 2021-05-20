<?php
session_start();
sessionIsValid();

$exception = null;
$userData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
  if ($_GET['update']==='') $_GET['update'] = $_SESSION['user']->id;
  $user = User::getOne(['id' => $_GET['update']]);
  $userData = $user->getValues();
  $userData['password'] = null;
} elseif(count($_POST) > 0) {
  try {
    $dbUser = new User($_POST);
    if($dbUser->id === $_SESSION['user']->id) {
      $user = User::getOne(['id' => $_SESSION['user']->id]);
      $userData = $user->getValues();
      $userData['password'] = $dbUser->password;
      $userData['confirm_password'] = $dbUser->confirm_password;
      $dbUser = new User($userData);
      $dbUser->update();
      addSuccessMsg('Senha alterada com sucesso!');
      header('Location: day_records.php');
      exit();
    }else{
      addErrorMsg('Ação não permitida!');
      header('Location: day_records.php');
      exit();
    }
    $_POST = [];
  } catch(Exception $e) {
    $exception = $e;
  } finally {
    $userData = $_POST;
  }
}

loadTemplateView('self_passwd', $userData + ['exception' => $exception]);