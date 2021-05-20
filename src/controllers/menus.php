<?php
session_start();
sessionIsValid(true);

$exception = null;
if(isset($_GET['delete'])) {
  try {
    Menu::deleteById($_GET['delete']);
    addSuccessMsg('Menu desativado com sucesso.');
  } catch(Exception $e) {
    if(stripos($e->getMessage(), 'FOREIGN KEY')) {
      addErrorMsg('Não é possível excluir o menu.');
    } else {
      $exception = $e;
    }
  }
}

$menusAdmin = Menu::get();


loadTemplateView('menus', ['menusAdmin' => $menusAdmin,'exception' => $exception]);