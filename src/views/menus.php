<main class="content">
  <?php
    $icon = "icofont-navigation-menu";
    $titulo = "Cadastro de Menus";
    $subtitulo = "Mantenha os dados dos menus atualizados";
    renderTitle($titulo, $subtitulo, $icon);
    include(TEMPLATE_PATH . "/messages.php");
  ?>

  <a class="btn btn-lg btn-primary mb-3"
    href="save_menu.php">Novo Menu</a>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <th>Nome</th>
        <th>Icone</th>
        <th>Privilegio Elevado</th>
        <th>Pagina</th>
        <th>Status</th>
        <th>Atualizado Em</th>
        <th>Ações</th>
      </thead>
      <tbody>
      <!-- (id, name, ico, elevate, page, ativo, updated) -->
      <?php foreach($menusAdmin as $menu): ?>
        <tr>
          <td><?= $menu->name ?></td>
          <td><i class="<?= $menu->ico ?>"></i></td>
          <td><?= $menu->elevate ? 'sim' : 'não' ?></td>
          <td><?= $menu->page ?></td>
          <td><?= $menu->ativo ? 'ativo' : 'desativado' ?></td>
          <td><?= $menu->updated ?></td>
          <td>
            <a href="save_menu.php?update=<?= $menu->id ?>" 
              class="btn btn-warning rounded-circle mr-2">
              <i class="icofont-edit"></i>
            </a>
            <?php if($menu->id != 7): ?>
            <a href="?delete=<?= $menu->id ?>"
              class="btn btn-danger rounded-circle">
              <i class="icofont-trash"></i>
            </a>
            <?php endif ?>
          </td>
        </tr>
      <?php endforeach?>
    </tbody>
  </table>
</main>