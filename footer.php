<?php 

    if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 1 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 2 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 3 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 4 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 5 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 6 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 7 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 8 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 9 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }else if ( isset($_SESSION) && isset($_SESSION['step']) && $_SESSION['step'] == 10 )  {
        echo "<div id='barre-jaune-footer' class='step-".$_SESSION['step']."'></div>";
    }
 ?>       
        <footer>
            <ul>
                <li><a href="contact.html" >Contact</a></li>
                <li><a href="#" >Facebook</a></li>
                <li><a href="legal.html" >Légal / CGV</a></li>
                <li><a href="signaler.html" >Signaler un profil</a></li>
            </ul>
        </footer>
        <script type="text/javascript" src="vendors/jquery/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="vendors/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="vendors/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>