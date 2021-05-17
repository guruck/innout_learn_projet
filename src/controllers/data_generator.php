<?php
loadModel('WorkingHours');

Database::executeFromQuery('DELETE FROM `innout`.`working_hours` WHERE id >= 1');
//Database::executeFromQuery('DELETE FROM `innout`.`users` WHERE id > 5');

function getDayTemplateDyOdds($regularRate, $extraRate, $lazyRate){
  $regularDayTemplate = [
    'time1' => '08:00:00',
    'time2' => '12:00:00',
    'time3' => '13:00:00',
    'time4' => '17:00:00',
    'worked_time' => DAILY_TIME,
  ];

  $extraHourDayTemplate = [
    'time1' => '08:00:00',
    'time2' => '12:00:00',
    'time3' => '13:00:00',
    'time4' => '18:00:00',
    'worked_time' => DAILY_TIME + 3600,
  ];

  $lazyDayTemplate = [
    'time1' => '08:00:00',
    'time2' => '12:00:00',
    'time3' => '13:00:00',
    'time4' => '16:00:00',
    'worked_time' => DAILY_TIME - 3600,
  ];

  $value = rand(1,100);
  if($value <= $regularRate){
    // echo 'regular';
    return $regularDayTemplate;
  }elseif($value <= $regularRate + $extraRate){
    // echo 'extra';
    return $extraHourDayTemplate;
  }else{
    // echo 'menor';
    return $lazyDayTemplate;
  }
}

function populateWorkingHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate){
  $currentDate = $initialDate;
  $yesterday = new DateTime();
  $yesterday->modify('-1 day');
  // $columns = ['id', 'user_id', 'work_date', 'time1', 'time2', 'time3', 'time4','worked_time']
  $columns = ['user_id' => $userId, 'work_date'=> $currentDate];
  while (isBefore($currentDate,$yesterday)) {
    if(!isWeekend($currentDate)){
      $template = getDayTemplateDyOdds($regularRate, $extraRate, $lazyRate);
      $columns = array_merge($columns,$template);
      $workingHours = new WorkingHours($columns);
      $workingHours->insert();
    }
    $currentDate =getNextDay($currentDate)->format('Y-m-d');
    $columns['work_date'] = $currentDate;
  }
}

$lastMonth = strtotime("first day of last month");
try {
  populateWorkingHours(1, date('Y-m-1'), 80, 15, 5);
  populateWorkingHours(3, date('Y-m-d',$lastMonth), 10, 85, 5);
  populateWorkingHours(4, date('Y-m-d',$lastMonth), 10, 15, 75);
} finally {
  //voltar para pagina principal
  echo '<a href="index.php">Home</a>';
}
