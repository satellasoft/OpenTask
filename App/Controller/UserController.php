<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\UserModel;
use App\Entity\User;

class UserController extends Controller{

  private $userModel;

  public function __construct(){
    parent::__construct();
    $this->userModel= new UserModel();
  }

  /*SHOW USER*/
  public function index(){
    $this->protectMethod();

    $this->Load("user/show.php", ["listUser" => $this->userModel->getAll()]);
  }

  public function Headerindex(){
    echo "<title>Login - User</title>";
  }

  /*CREATE USER*/
  public function create(){
    $this->protectMethod();
    $this->Load("user/create.php");
  }

  public function Headercreate(){
    echo "<title>Login - User Create</title>";
  }

  /*CREATE USER*/
  public function store(){
    $this->protectMethod();
    $user = new User(
      null,//ID
      filter_input(INPUT_POST, "txtName", FILTER_SANITIZE_STRING),
      filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL),
      filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING),
      passwordHash(filter_input(INPUT_POST, "txtPassword", FILTER_SANITIZE_STRING)),
      filter_input(INPUT_POST, "slPermission", FILTER_SANITIZE_NUMBER_INT),
      filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT),
      getCurrentDate()
    );

    $msg = "";

    if($this->userModel->store($user))
    $msg = "Usuário registrado";
    else
    $msg = "Erro ao tentar registrar usuário";

    $this->Load("user/store.php", ["message" => $msg]);
  }

  public function Headerstore(){
    echo "<title>Login - User Store</title>";
  }

  /*EDIT/UPDATE USER*/
  public function edit($id = 0){
    $this->protectMethod();
    $user = $this->userModel->getById($id);

    if($user->name == null){
      $this->Load("layout/404.php");
    }else{
      $this->Load("user/edit.php", compact("user"));
    }
  }

  public function Headeredit(){
    echo "<title>Login - User Edit</title>";
  }

  public function update(){
    $this->protectMethod();
    $user = new User(
      filter_input(INPUT_POST, "txtId", FILTER_SANITIZE_NUMBER_INT),//ID
      filter_input(INPUT_POST, "txtName", FILTER_SANITIZE_STRING),
      filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL),
      filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING),
      null,//password
      filter_input(INPUT_POST, "slPermission", FILTER_SANITIZE_NUMBER_INT),
      filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT)
    );

    $msg = "";

    if($this->userModel->update($user))
    $msg = "Usuário alterado";
    else
    $msg = "Erro ao tentar alterar usuário";

    $this->Load("user/update.php", ["message" => $msg]);
  }

  public function Headerupdate(){
    echo "<title>Login - User Update</title>";
  }

  /*CREATE USER*/
  public function passwordReset($userId){
    $this->protectMethod();
    $password =  passwordHash(DEFAULT_USER_PASS);
    $msg;

    if($this->userModel->passwordReset($userId, $password))
    $msg = "Senha redefinida.";
    else
    $msg = "Houve um erro ao tentar alterar a senha";

    $this->Load("user/passwordreset.php", ["message" => $msg]);
  }

  public function HeaderpasswordReset(){
    echo "<title>Login - User Password Reset</title>";
  }

  /*CHANGE PASSOWORD USER*/
  public function passwordchange(){
    $this->Load("user/passwordchange.php", ["message" => $_SESSION["n"]]);
  }

  public function Headerpasswordchange(){
    echo "<title>Login - Change password</title>";
  }

  public function passwordUpdate(){

    $pass = trim(filter_input(INPUT_POST, "txtPassword", FILTER_SANITIZE_STRING));
    $msg = "";
    if(strlen($pass) >= 7){
      $password =  passwordHash($pass);

      if($this->userModel->passwordReset($_SESSION["i"], $password)){
        $msg = "<span class='text-success'>Senha alterada.</span>";
      }else{
        $msg = "<span class='text-danger'>Houve um erro ao tentar alterar a senha, tente mais tarde.</span>";
      }
    }else{
      $msg = "<span class='text-warning'>Senha inválida.</span>";
    }
    $this->Load("user/passwordupdate.php", ["message" => $msg]);
  }

  public function Headerpasswordupdate(){
    echo "<title>Login - Changed password</title>";
  }
}
?>
