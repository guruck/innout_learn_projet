<?php
class Login extends Model{

  public function validate(){
    $errors = [];

    if(!$this->email){
      $errors['email'] = 'E-mail é um campo obrigatório!';
    }
    if(!$this->password){
      $errors['password'] = 'Informe a senha para efetuar login!';
    }

    if(count($errors) > 0){
      throw new ValidationException($errors);
    }
  }

  public function checkLogin(){
    $this->validate();
    $user = USER::getOne(['email' => $this->email]);
    if($user){
      if ($user->end_date){
        throw new AppException('Usuario desligado...');
      }
      if(password_verify($this->password, $user->password )){
        return $user;
      };
    };
    throw new AppException('Usuario e senha invalidos...'); //Exception();
  }

}
