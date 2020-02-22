<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\ProjectModel;
use App\Model\CategoryModel;
use App\Entity\Category;

class CategoryController extends Controller{

  private $categoryModel;

  public function __construct(){
    parent::__construct();

    $this->categoryModel = new CategoryModel();
  }

  public function index(){
    $this->Load("layout/404.php");
  }

  public function show($projectId  = 0){
    $projectId = filter_var($projectId, FILTER_SANITIZE_NUMBER_INT);

    if($projectId <= 0){
      $this->Load("layout/404.php");
      return;
    }

    $project = (new ProjectModel)->getResumeById($projectId);

    $this->Load("category/show.php", [
      "categoryList"  => $this->categoryModel->getAllByProjectId($projectId),
      "projectId" => $projectId,
      "project"   => $project
    ]);
  }

  public function headershow(){
    echo "<title>Categorias - Open Task</title>";
  }

  public function create($projectId  = 0){
    $projectId = filter_var($projectId, FILTER_SANITIZE_NUMBER_INT);

    if($projectId <= 0){
      $this->Load("layout/404.php");
      return;
    }

    $this->Load("category/create.php", [
      "projectId" => $projectId,
    ]);
  }

  public function headercreate(){
    echo "<title>Nova Categoria - Open Task</title>";
  }

  public function edit($categoryId = 0){
    $categoryId = filter_var($categoryId, FILTER_SANITIZE_NUMBER_INT);

    if($categoryId <= 0){
      $this->Load("layout/404.php");
      return;
    }

    $this->Load("category/edit.php", [
      "category" => $this->categoryModel->getById($categoryId)
    ]);
  }

  public function headeredit(){
    echo "<title>Editar Categoria - Open Task</title>";
  }

  public function store(){
    $projectId = filter_input(INPUT_POST, "txtProjectId", FILTER_SANITIZE_NUMBER_INT);
    $title     = filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING);

    if($projectId <= 0 || strlen($title) < 3){
      $this->Load("message/nolink.php", ["message" => "Formulário inválido"]);
      return;
    }

    $category = new Category(null, $title, getCurrentDate());
    $category->getProject()->setId($projectId);

    if($this->categoryModel->store($category)){
      redirect(BASE . "category/show/".$projectId);
    }else{
      $this->Load("message/nolink.php", ["message" => "Houve um erro ao tentar realizar o cadastro. Tente novamente mais tarde."]);
    }
  }

  public function update(){
    $id        = filter_input(INPUT_POST, "txtId", FILTER_SANITIZE_NUMBER_INT);
    $projectId = filter_input(INPUT_POST, "txtProjectId", FILTER_SANITIZE_NUMBER_INT);
    $title     = filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING);

    if($id <=0 || $projectId <= 0 || strlen($title) < 3){
      $this->Load("message/nolink.php", ["message" => "Formulário inválido"]);
      return;
    }

    $category = new Category($id, $title, getCurrentDate());

    if($this->categoryModel->update($category)){
      redirect(BASE . "category/show/".$projectId);
    }else{
      $this->Load("message/nolink.php", ["message" => "Houve um erro ao tentar realizar o cadastro. Tente novamente mais tarde."]);
    }
  }
}
