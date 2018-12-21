<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');

if(isset($_GET['gestionfichier'])){
  $user_id=$_GET['id'];


}else{

    $selectid = $db->prepare("SELECT distinct user_id FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date");
    $selectid->execute();
    $countid = $selectid->rowCount();
    echo $countid;
    if($countid>'0'){
      while($uneselectid = $selectid->fetch(PDO::FETCH_OBJ)){

        $user_id = $uneselectid->user_id;
        echo $user_id;
        $selectnom = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
        $selectnom->execute(array(
            "user_id"=>$user_id
            )
        );
        $table = $selectnom->fetch(PDO::FETCH_OBJ);
        
        if(count($table)>0){
          echo "<h3>".count($table)." documents trouvés</h3>";
          echo '
          <table class="table">
          <thead>
          <tr>
          <th scope="col">Pseudo</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>

          ';
          foreach($table as $ligne){
            $username = $ligne->username;
            $email = $ligne->email;
            $status = $ligne->status;

            echo '
            <h2>ok4</h2>
            <tr>
              <th scope="row">'.$username.'</th>
              <td>'.$email.'<td>
              <td>'.$status.'</td>

              <td>
          <a href="?action=gestionfichier&amp;id='.$user_id.'">
          <button type="button" class="btn">Afficher</button>
          </a>
              </td>
            </tr>
        <hr>
            ';


          }

          echo '
        </tbody>
        </table>


          ';

}
}
}



}





require_once('includes/footer.php');

require_once('includes/javascript.php');
?>
