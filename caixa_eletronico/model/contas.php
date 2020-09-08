<?php

class Contas extends Conexao{
    //metodo para efetuar transação
    public function settransacao($tipo,$valor){
      $pdo = parent::get_instance();
      $sql = "INSERT INTO historico (id_conta , tipo ,valor , data_operacao)
       VALUES (:id_conta , :tipo , :valor , NOW())";
      $sql = $pdo->prepare($sql);
      $sql->bindValue(":id_conta", $_SESSION['login']);
      $sql->bindValue(":tipo",$tipo);
      $sql->bindValue(":valor",$valor);
      $sql->execute();
   
   

     if($tipo == "Deposito"){

        //desposito
       $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id = :id";
       $sql = $pdo->prepare($sql);
       $sql->bindValue(":valor",$valor);
       $sql->bindValue(":id", $_SESSION['LOGIN']);
       $sql->execute();
    }  else{

        //metodo de retirada de saldo
        $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":valor",$valor);
        $sql->bindValue(":id",$_SESSION['LOGIN']);
        $sql->execute();
    } 

    }



    //listar contas do clientes
    public function listAccounts(){
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas ORDER BY id ASC";
        $sql = $pdo->prepare($sql);
        $sql->execute();


        if($sql->rowCount()> 0){
            return $sql->fetchAll();
        }
    }
  //metodo de listar historico das contas 
  public function listHistorico($id){
      $pdo = parent::get_instance();
      $sql = "SELECT * FROM historico WHERE id_conta = :id_conta"; 
      $sql = $pdo->prepare($sql);
      $sql->bindValue(":id_conta",$id);
      $sql->execute();

      if($sql->rowCount() > 0){
        return $sql->fetchAll();
      }
  }  


  //metodo para listar todas as contas do sistemas
  public function getInfo($id){
    $pdo = parent::get_instance();
    $sql = "SELECT * FROM contas WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->execute();

    if($sql->rowCount() > 0){
        return $sql->fetchAll();
    }
 
  }  

//metodo de locale_get_display_name
public function setLogget($agencia,$conta,$senha){
    $pdo = parent::get_instance();
    $sql = "SELECT * FROM contas WHERE agencia = :agencia AND conta =:conta AND senha = :senha";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":agencia",$agencia); 
    $sql->bindValue(":conta",$conta); 
    $sql->bindValue(":senha",$senha); 
    $sql->execute();

    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        $_SESSION['login'] = $sql['id'];

        header("location: ../index.php?login_sucess");
        exit;
    }else{
        header("location: ../index.php?not_login");
    }
    
}
 //metodo para fazer logout
 public function logout(){
     unset($_SESSION['login']);
 }

}
?>