<?php

session_start();
sessionIsValid();


loadModel('WorkingHours');

  $i1 = DateInterval::createFromDateString('9 hours');
  $i2 = DateInterval::createFromDateString('6 hours');

  // $r1 = sumIntervals($i1, $i2);

  // $r1 = subtractIntervals($i1, $i2);
  // $r1 = intervalToDate($r1);
  
  //$r1 = stringToDate('08:09:20');
  
  $user = $_SESSION['user'];
  $records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

  //privado/$r1 = $records->getTimes();

  //horario do almoço
  // $interval = $records->getLunchInterval();
  // $r1 = intervalToString($interval);
  // $r1 = $interval ;
  
  // $r1 = $records->getExitTime();
  
  // $r1 = getLastDayOfMonth('2021-02-16');
  // $r1 = getLastDayOfMonth(new DateTime());

  $r1 = WorkingHours::getMonthlyReport($user->id,date('Y-m-d'));

  
  // tela para teste
  if(!isset($r1)) $r1 = 'testando';
  loadTemplateView('home', ['resultado'=>$r1]);