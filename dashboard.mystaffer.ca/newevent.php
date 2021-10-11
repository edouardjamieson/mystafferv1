<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>MyStaffer - Panneau de contrôles</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="content/css/main.css">
    <link rel="stylesheet" href="content/css/dashboard.css">
</head>
<body onload="side();">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="content/js/main.js" type="text/javascript"></script>
<script src="content/js/side.js" type="text/javascript"></script>

<div class="loading">
    <img src="content/img/ajax-loader.gif" alt="" draggable="false">
</div>
<div id="main-frame">
   <script type="text/javascript">
   if ('serviceWorker' in navigator) {
   navigator.serviceWorker.register('service-worker.js');
   }
   </script>

    <div class="dash-navigation">
        <div class="dn-content">

            <div class="dnc-icons">
                <div class="dn-link menu-icon" style="margin-bottom:20%;" onclick="openMenu()">
                    <img src="content/img/menu-icon.png" alt="" class="nav-icon x-icon">
                </div>
                <div class="dn-link" onclick="location.href='home'">
                    <img src="content/img/home-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link" onclick="location.href='staff'">
                    <img src="content/img/name-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link" onclick="location.href='posts'">
                    <img src="content/img/newpost-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link dnl-active" onclick="location.href='events'">
                    <img src="content/img/event-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link" onclick="location.href='schedule'">
                    <img src="content/img/schedule-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link" onclick="location.href='settings'">
                    <img src="content/img/settings-icon.png" alt="" class="nav-icon">
                </div>
                <div class="dn-link" onclick="location.href='logout'">
                    <img src="content/img/logout-icon.png" alt="" class="nav-icon">
                </div>

            </div>
            <div class="dn-labels">
                <div class="dn-label" onclick="closeMenu()" style="margin-bottom:10%;">Fermer</div>
                <div class="dn-label" onclick="location.href='home'">Accueil</div>
                <div class="dn-label" onclick="location.href='staff'">Employés</div>
                <div class="dn-label" onclick="location.href='posts'">Publications</div>
                <div class="dn-label" onclick="location.href='events'">Évènements</div>
                <div class="dn-label" onclick="location.href='schedule'">Horaires</div>
                <div class="dn-label" onclick="location.href='settings'">Paramètres</div>
                <div class="dn-label" onclick="location.href='logout'">Déconnexion</div>
            </div>
        </div>

    </div>

    <div class="dash-wrapper">
      <?php

      if(!isset($_COOKIE["session"])){
         header("Location:login");
      }


      $nocommerce = $_COOKIE["nocommerce"];
      $db = "admin_".$nocommerce;
      $conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);
      $getentinfos = mysqli_query($conn, "SELECT * FROM entreprise");
      while($entinfos = mysqli_fetch_array($getentinfos)){

         //check session
         $coksess = $_COOKIE["session"];
         $sessnb = $entinfos["session"];
         if($coksess != $sessnb){
            header("Location:logout");
         }
      }

      ?>
        <div class="wrapper">
            <div class="wrp-header">
                <img src="content/img/logo-full.png" class="hdr-logo" alt="">
                <img src="content/img/search-icon.png" class="hdr-search" alt="">
            </div>
            <div class="content-title">Créer un évènement</div>

            <div class="page-subnav">
                <a href="events" class="psub-link">Retour aux évènements</a>
            </div>

            <div class="newevent-layout">
                <div class="newevent-ctn">
                    <form method="post">
                        <input type="text" name="nev-name" class="newevent-tb" placeholder="Nom du nouvel évènement">
                        <textarea name="nev-text" class="newevent-text" placeholder="Écrivez une courte description de l'évènement comme un habit, une nourriture, ou tout autres informations utiles"></textarea>
                        <input type="text" name="nev-date" placeholder="Choisir une date pour l'évènement" onfocus="(this.type='date')" class="newevent-tb" style="margin-top: 1%;">
                        <div class="np-submitbtn hovshadow">
                            <input type="submit" name="createevent" value="Créer" class="np-submit">
                        </div>

                        <?php

                        if(isset($_POST["createevent"])){


                           $nename = mysqli_real_escape_string($conn, $_POST["nev-name"]);
                           $netext = mysqli_real_escape_string($conn, $_POST["nev-text"]);
                           $nedate = htmlentities($_POST["nev-date"]);

                           if(empty($nename)){
                              echo "<script>alert('Votre évènement doit avoir un nom!');</script>";
                           }
                           if(empty($netext)){
                              echo "<script>alert('Votre évènement doit avoir une description!');</script>";
                           }
                           if(empty($nedate)){
                              echo "<script>alert('Votre évènement doit avoir une date!');</script>";
                           }
                           if(!empty($nename && $netext && $nedate)){
                              $addevent = mysqli_query($conn, "INSERT INTO events (name,desc,date) VALUES ('$nename','$netext','$nedate')");
                              echo "<script>location.href='event';</script>";
                           }

                        }


                         ?>

                    </form>

                </div>
            </div>



        </div>
    </div>



</div>
<script language="javascript" type="text/javascript">
    $(window).load(function() {
        $('.loading').hide();
    });
</script>

</body>
</html>
