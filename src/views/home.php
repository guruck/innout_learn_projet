<main class="content">
  <h2>Tela para TESTES, <?= $_SESSION['user']->name; ?></h2>
  <p>
  <?php 
    if(is_array($resultado)){
      echo gettype($resultado), ":<br/>";
      foreach ($resultado as $value) {
        var_dump($value);
        echo '<br/>';
      }
    }
    elseif(is_object($resultado)){
      echo get_class($resultado), ":<br/>";
      foreach ($resultado as $key => $value) {
        echo "{$key} => {$value} <br/>";
      }
    }
    elseif(is_string($resultado)){
      echo $resultado;
    }else{
      var_dump($resultado);
    }
    
  ?>
  </p>
</main>