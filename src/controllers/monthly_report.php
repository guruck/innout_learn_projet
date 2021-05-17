<?php
  session_start();
  sessionIsValid();

  $currentDate = new DateTime();

  $user = $_SESSION['user'];
  $registries = WorkingHours::getMonthlyReport($user->id,$currentDate);

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
    ]
  );
