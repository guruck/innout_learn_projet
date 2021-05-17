<?php
  
  require_once(dirname(__FILE__,2) . '/src/config/config.php');
  $uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
  );

  if($uri === '/' || $uri === ''|| $uri === '/index.php'){
    $uri = '/day_records.php';
  }

  require_once(CONTROLLER_PATH . $uri);



  // loadModel('User');
  // loadModel('Login');
  // loadView('login', ['texto'=>'abc123']);


  // require_once(MODEL_PATH . '/UserDAO.php');
  // require_once(MODEL_PATH . '/LoginDAO.php');
  // require_once(VIEW_PATH . '/login.php');
  // require_once(CONTROL_PATH . '/login.php');
  
  //Teste da função getConnection
  //$conect = Database::getConnection();

  //Teste da função getResultFromQuery
  // $sql = 'SELECT * FROM innout.users';
  // $result = Database::getResultFromQuery($sql);
  // while ($row = $result->fetch_assoc()) {
  //   print_r($row);
  //   echo '<BR/>';
  // }

  // $user = new User(['id'=>'99','nome'=>'Marieta Rodrigues','password'=>'$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.','email'=>'marieta@rodrigues.com.br','start_date'=>'2005-11-20','end_date'=>null, 'is_admin' => 1]);
  // print_r($user->email);

  // echo '<BR/><BR/>';
  // $user->email = 'anoanoanoano';
  // print_r($user->email);
  
  // echo '<BR/>',print_r($user->getResultSetFromSelect([],'id, name, email')),'<BR/>';
  // echo '<BR/>',print_r(USER::get(['id'=>1])),'<BR/>';
  
  // foreach (USER::get() as $user) {
  //   # code...
  //   echo $user->name,'<BR/>';
  // }

  // $user = USER::getOne(['email'=>'admin@cod3r.com.br'],'id, name, email');
  // echo $user->id,'<BR/>';
  // echo $user->name,'<BR/>';
  // echo $user->email,'<BR/>';

  //teste no login
  // $login = new Login(['email'=>'admin@cod3r.com.br','password'=>'a']);
  // try {
  //   $user = $login->checkLogin();
  //   echo $user->id,'<BR/>';
  //   echo $user->name,'<BR/>';
  //   echo $user->email,'<BR/>';
  // } catch (\Exception $th) {
  //   echo " Ixi deu erro no login! ";
  // }


  // echo "<BR/><BR/> Ola Mundo! " ;//. MODEL_PATH;
  //phpinfo();