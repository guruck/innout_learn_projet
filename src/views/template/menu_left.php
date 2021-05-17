<aside class="sidebar">
  <nav class="menu mt-3">
    <ul class="nav-list">
      <li class="nav-item">
        <a href="day_records.php">
          <i class="icofont-ui-check mr-2"></i>
          Registrar Ponto
        </a>
      </li>
      <li class="nav-item">
        <a href="monthly_report.php">
          <i class="icofont-ui-calendar mr-2"></i>
          Relatorio Mensal
        </a>
      </li>
      <li class="nav-item">
        <a href="manager_report.php">
          <i class="icofont-chart-histogram mr-2"></i>
          Relatorio Gerencial
        </a>
      </li>
      <li class="nav-item">
        <a href="users.php">
          <i class="icofont-users mr-2"></i>
          Usuários
        </a>
      </li>
      <div class="division my-3"></div>
      <li class="nav-item">
        <a href="teste.php">
          <i class="icofont-test-tube-alt mr-2"></i>
          Testes
        </a>
      </li>
      <li class="nav-item">
        <a href="data_generator.php">
          <i class="icofont-skull-danger mr-2"></i>
          Zerar Ponto do Dia
        </a>
      </li>
    </ul>
  </nav>
  <div class="sidebar-widgets">
    <div class="sidebar-widget">
      <i class="icon icofont-hour-glass text-primary"></i>
      <div class="info">
        <span class="main text-primary" <?= $activeClock === 'workedInterval' ? 'active-clock="true"' : '' ?>>
          <?= $workedInterval ?>
        </span>
        <span class="lable text-mute">
          Horas Trabalhadas
        </span>
      </div>
    </div>
    <div class="division my-3"></div>
    <div class="sidebar-widget">
      <i class="icon icofont-ui-alarm text-danger"></i>
      <div class="info">
        <span class="main text-danger" <?= $activeClock === 'exitTime' ? 'active-clock="true"' : '' ?>>
          <?= $exitTime ?>
        </span>
        <span class="lable text-mute">
          Horas de Saída
        </span>
      </div>
    </div>
  </div>
</aside>