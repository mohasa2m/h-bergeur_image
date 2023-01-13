<?php
//VERIFIER SI IMAGE EST BIEN RECU
if(isset($_FILES['image']) && $_FILES['image']['error']==0){
    //VARIABLE 
    $error=1;

    //ON VOIT SI TAILLE TROP GRANDE
    if($_FILES['image']['size']<=3000000){

        //VON VOIT LE TYPE OU DIT EXTENSION
        $informationsImage= pathinfo($_FILES['image']['name']);
        $extensionImage=$informationsImage['extension'];
        $extensionArray=array('jpg','png','jpeg','gif');
        if(in_array($extensionImage, $extensionArray)){


            $adress= 'uploades/'.time().rand().rand().'.'.$extensionImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $adress);
            $error=0;
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>    
  <meta charset="utf-8">
  <title>Hébergeur d'images gratuit</title>
  <style type="text/css">
    html, body {margin: 0; font-family: Georgia;}
    header {text-align: center; color: white; background: red;}
    article {margin-top: 50px; background: #f7f7f7; padding: 10px;}
    h1{margin-top:0;text-align:center}
    #presentation-picture{text-align: center}
    #images{max-width:100px}
    button{margin-top:10px;}
    .contener {width: 500px; margin: auto;}
  </style>
</head>
<body>

  <!--Header-->
  <header>
    <h2>PHOTOSHOOT</h2>
  </header>

  <!--FORMULAIRE-->

  <div class="contener">
    <article>
      <h1>Hébergez une image</h1>
        <?php
            if (isset($error) && $error ==0){
              echo '<div id="presentation-picture"><img src="'.$adress.'" id="image"/></div>';
              //La balise </div> est preferables la mettre en haut plutot qu'apres le deuxieme echo.
              //Meilleur pour la comprehnsion et l'organisation du code.
              echo '<input type="text" value="http://localhost/'.$adress.'"/>';

            }else if (isset($error) && $error ==1){
              echo 'Votre image ne peut pas être envoyée. Vérifier son extension et sa taille (maximum à 3 mo).';
            }
        ?>
      
      <form method="post" action="deuxieme_projet.php" 
      enctype="multipart/form-data">
      <p>
        <input type="file"  required name="image"/> </br>
        <div style= "text-align: center;">
        <button type="submit">Héberger</button>
        </div>
    </p>
    </form>
    </article>
  </div>   

</body>
</html>

