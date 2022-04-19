<?php
include __DIR__ . '/../Database/DB.php';
include __DIR__ . '/../routes/index.php';

class connected_user
{
   private $email;
   protected $connexion;
   protected $bdd;
   private $user_id;
   private $user_email;
   private $user_pseudo;
   private $text_post;
   private $session_cred;

   public function __construct()
   {
      // $this->email = $_SESSION["email"];
      $this->connexion = new DB();
      $this->bdd = $this->connexion->getDB();
$this->session_cred = $_SESSION["email"];
   }
   public function set_user() {
      $user = $this->bdd->query("SELECT * from users where email like '$this->session_cred'");
      $rows = $user->fetch(PDO::FETCH_ASSOC);
      
      $this->user_email = $rows["email"];
      $this->user_id = $rows["id"];
      $this->user_pseudo= $rows["pseudo"];
      
      
   }
   
   public function get_user_pseudo() {

return  $this->user_pseudo;


}
   

   

}


$connecte_user = new connected_user();
   $connecte_user->set_user();
   echo $connecte_user->get_user_pseudo();


