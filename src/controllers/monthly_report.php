<?php
  session_start();
  sessionIsValid();

  $currentDate = new DateTime();
  $users = null;
  $user = $_SESSION['user'];

  if ($user->is_admin){
    $users = User::get();
  }

  $userIdSelected = $_POST['userId'] ? $_POST['userId'] : $user->id;
  $selectedPeriod = $_POST['period'] ? $_POST['period'] : $currentDate->format('Y-m');
  $periods = [];

  for($yearDiff = 0; $yearDiff <= 2; $yearDiff++){
    $year = date('Y') - $yearDiff;
    $mth = 12;
    if($year == date('Y')) $mth = date('m');
    for($month = $mth; $month >= 1; $month--){
      $date = new DateTime("{$year}-{$month}-1");
      $periods[$date->format('Y-m')] = utf8_encode(strftime('%B de %Y',$date->getTimestamp()));
    }
  }


  $registries = WorkingHours::getMonthlyReport($userIdSelected,$selectedPeriod);

  $report = [];
  $workday = 0;
  $expectedTime = 0;
  $sumOfWorkedTime = 0;
  $lastDay = getLastDayOfMonth($currentDate)->format('d');
  

  for ($day=1; $day <= $lastDay ; $day++) { 
    $date = $currentDate->format('Y-m') . '-' . sprintf('%02d',$day);
    $registry = $registries[$date];
    
    if(isPastWorkDay($date)) $workday++;

    if($registry){
      $sumOfWorkedTime += $registry->worked_time;
      array_push($report, $registry);
    }else{
      array_push($report, new WorkingHours([
        'work_date' => $date,
        'worked_time' => 0
        ])
      );
    }
  }

  $expectedTime = $workday * DAILY_TIME;
  $balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
  $sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';

  loadTemplateView('monthly_report',[
    'report'=>$report, 
    'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
    'expectedTime' => getTimeStringFromSeconds($expectedTime),
    'balance' => $balance,
    'sign' => $sign,
    'periods' => $periods,
    'selectedPeriod' => $selectedPeriod,
    'users' => $users,
    'userIdSelected' => $userIdSelected,
    ]
  );
