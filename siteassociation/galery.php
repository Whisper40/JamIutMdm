<?php
require_once('includes/head.php');
require_once('includes/header.php');
 ?>

 <div class="gallery">
    <?php
    // Include database configuration file


    // Retrieve images from the database
    $query = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $imageThumbURL = 'assets/images/thumb/'.$row["file_name"];
            $imageURL = 'assets/images/'.$row["file_name"];
    ?>
        <a href="<?php echo $imageURL; ?>" data-fancybox="gallery" data-caption="<?php echo $row["title"]; ?>" >
            <img src="<?php echo $imageThumbURL; ?>" alt="" />
        </a>
    <?php }
    } ?>
</div>

<!-- Fancybox CSS library -->
<link rel="stylesheet" type="text/css" href="includes/fancybox/jquery.fancybox.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Fancybox JS library -->
<script src="includes/fancybox/jquery.fancybox.js"></script>

<script>
$("[data-fancybox]").fancybox();
</script>

<style>

.gallery img {
    width: 20%;
    height: auto;
    border-radius: 5px;
    cursor: pointer;
    transition: .3s;
}
</style>
