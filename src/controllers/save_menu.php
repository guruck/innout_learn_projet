<?php
session_start();
sessionIsValid(true);

$exception = null;
$menuData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
  $menu = Menu::getOne(['id' => $_GET['update']]);
  $menuData = $menu->getValues();
} elseif(count($_POST) > 0) {
  try {
    $dbMenu = new Menu($_POST);
    if($dbMenu->id) {
      $dbMenu->update();
      addSuccessMsg('Menu alterado com sucesso!');
      header('Location: menus.php');
      exit();
    } else {
      $dbMenu->insert();
      addSuccessMsg('Menu cadastrado com sucesso!');
    }
    $_POST = [];
  } catch(Exception $e) {
    $exception = $e;
  } finally {
    $menuData = $_POST;
  }
}

loadTemplateView('save_menu', $menuData + ['exception' => $exception]);