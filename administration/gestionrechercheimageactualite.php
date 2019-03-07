<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];
  $idactu=$_GET['id'];

  $select = $db->prepare("SELECT slug FROM newsactus WHERE title LIKE '%$critere%'");
  $select->execute();
  $s = $select->fetch(PDO::FETCH_OBJ);
  $nomreel = $s->slug;

  $requete=$db->prepare("SELECT * FROM carousel WHERE slug = '$nomreel' OR image LIKE '%$critere%'");
  $requete->execute();
  $table=$requete->fetchAll(PDO::FETCH_OBJ);

  if(count($table)>0){
    echo '
    <div class="table-responsive">
      <table class="table">
          <thead class="text-primary">
              <th class="text-center">Identifiant</th>
              <th class="text-center">Actualité</th>
              <th class="text-center">Catégorie</th>
              <th class="text-center">Nom</th>
              <th class="text-center">Titre</th>
              <th class="text-center">Action</th>
          </thead>
          <tbody>
      ';

    foreach($table as $ligne){
      $idimg=$ligne->id;

      $slug=$ligne->slug;

      $select2 = $db->prepare("SELECT title FROM newsactus WHERE slug=:slug");
      $select2->execute(array(
        "slug"=>$slug
      ));
      $s2 = $select2->fetch(PDO::FETCH_OBJ);
      $nomacti = $s2->title;

      $categorie=$ligne->titre;
      $nom=$ligne->image;
      $titreimage=$ligne->titreimage;

    echo '
      <tr>
        <th class="text-center">'.$idimg.'</th>
        <th class="text-center">'.$nomacti.'</th>
        <td class="text-center">'.$categorie.'<td>
        <td class="text-center">'.$nom.'</td>
        <td class="text-center">'.$titreimage.'</td>
        <td class="text-center"><a href="modifdespages.php?page=actualite&table=newsactus&action=delete&modifactus='.$idactu.'&id='.$idimg.'"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a></td>
      </tr>
    ';
  }

      echo '
    </tbody>
  </table>
</div>

  ';

}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun résultats à votre recherche</font></h4>
           </center>';

}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun critere de recherche n&apos;a été fournis</font></h4>
           </center>';
