<?php

class Menu extends Model{
  protected static $tableName = '`innout`.`menus`';
  protected static $columns = ['id','name','ico','elevate','page','ativo','updated'];

  public function insert() {
    $this->validate();
    $this->elevate = $this->elevate ? 1 : 0;
    $this->ativo = $this->ativo ? 1 : 0;
    $currentDate = new DateTime();
    $this->updated = $currentDate->format('Y-m-d');
    return parent::insert();
  }

  public function update() {
    $this->validate();
    $this->elevate = $this->elevate ? 1 : 0;
    $this->ativo = $this->ativo ? 1 : 0;
    $currentDate = new DateTime();
    $this->updated = $currentDate->format('Y-m-d');
    return parent::update();
  }
  
  public static function deleteById($id) {
    $currentDate = new DateTime();
    $sql = "UPDATE " . static::$tableName . " SET ativo = 0, updated = '" . $currentDate->format('Y-m-d') . "' WHERE id = {$id} ";
    Database::executeFromQuery($sql);
  }

  private function validate() {
    $errors = [];

    if(!$this->name) {
      $errors['name'] = 'Nome é um campo abrigatório.';
    }

    if(count($errors) > 0) {
      throw new ValidationException($errors);
    }
  }
}