<?php
  require_once('config.php')
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Thunder Pizza</title>
        <link rel="shortcut icon" href="../png/pizza.png"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- BOTSTRAP -->
          <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- --- -->

        <!-- CSS -->
        <link rel="stylesheet"href="../css/main_style.css">
        <!-- --- -->

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- --- -->
        
        <!-- JS -->
        <script src = "../js/ap.js"></script>
        <!--  -->

        <!-- FontAwesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->
      </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div>
        <?php
            session_start();
            if(isset($_POST['Zarejestruj'])){
                $dmail=mysqli_connect($host, $db_user, $db_pass, $db_name);
                $znalazl = false;
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $display_name = $_POST['display_name'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
                $password = $_POST['password'];
                $password_conf = $_POST['password_confirmation'];
                $checkemail = "SELECT * FROM user";


                $_SESSION['zp_first_name'] = $first_name;
                $_SESSION['zp_last_name'] = $last_name;
                $_SESSION['zp_display_name'] = $display_name;
                $_SESSION['zp_email'] = $email;
                $_SESSION['zp_phonenumber'] = $phonenumber;
                $_SESSION['zp_password'] = $password;
                if (isset($_POST['t_and_c'])) $_SESSION['zp_t_and_c'] = true;
                $result2 = mysqli_query($dmail, $checkemail);
                if ($password != $password_conf){
                        $_SESSION['blad'] = "<div class='alert alert-warning role='alert'>Podane hasła różnią się!</div>";
                        echo $_SESSION['blad'];
                        unset($_SESSION['blad']);
                }else{      
                    $pass_hash = password_hash($password, PASSWORD_DEFAULT);  
                    while($mailrow = mysqli_fetch_array($result2)){
                        if(strtoupper($_POST['email']) === strtoupper($mailrow['email'])){
                            $znalazl = true;
                        };  
                    };      
                    mysqli_close($dmail);    
                    if($znalazl){
                        $_SESSION['blad'] = "<div class='alert alert-warning role='alert'>Taki Email jest zajerestrowany!</div>";
                        echo $_SESSION['blad'];
                        unset($_SESSION['blad']);
                    }else{
                        if (isset($_POST['t_and_c']))
                        {
                            $sql = "INSERT INTO user (first_name, last_name, display_name, email, phonenumber, password ) VALUES(?,?,?,?,?,?) ";
                            $stmtinsert = $db->prepare($sql);
                            $result = $stmtinsert->execute([$first_name,  $last_name, $display_name,  $email,  $phonenumber,  $pass_hash]);
                            if($result){
                                header("Location: ../web/welcome.php");
                                $_SESSION['rejestracja'] = true;
                                $_SESSION['sukces'] = "<div class='alert alert-success role='alert'>Rejestracja pomyślna!</div>";
                            }else {
                                echo "Error";
                            }
                        }else{
                            $_SESSION['blad'] = "<div class='alert alert-warning role='alert'>Regulamin nie został zaackeptowany!</div>";
                            echo $_SESSION['blad'];
                            unset($_SESSION['blad']);
                        }
                    }
                }
            }
        ?>
    </div>  
    
    <div class="container-register">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form action="rejestracja.php" method="post">
                    <h2>Rejestracja<small> THUNDER PIZZA</small></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="first_name" id="first_name" value = "<?php
                                    if(isset($_SESSION['zp_first_name']))
                                    {
                                    echo $_SESSION['zp_first_name'];
                                    unset($_SESSION['zp_first_name']);
                                    }
                                ?>" class="form-control input-lg" placeholder="Imie" tabindex="1" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name"  value = "<?php
                                    if(isset($_SESSION['zp_last_name']))
                                    {
                                    echo $_SESSION['zp_last_name'];
                                    unset($_SESSION['zp_last_name']);
                                    }
                                ?>" class="form-control input-lg" placeholder="Nazwisko" tabindex="2" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                    <input type="text" name="display_name" id="display_name"  value = "<?php
                                    if(isset($_SESSION['zp_display_name']))
                                    {
                                    echo $_SESSION['zp_display_name'];
                                    unset($_SESSION['zp_display_name']);
                                    }
                                ?>"  class="form-control input-lg" placeholder="Nazwa" tabindex="3" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="phonenumber" id="phonenumber"  value = "<?php
                                    if(isset($_SESSION['zp_phonenumber']))
                                    {
                                    echo $_SESSION['zp_phonenumber'];
                                    unset($_SESSION['zp_phonenumber']);
                                    }
                                ?>" class="form-control input-lg" placeholder="Numer Telefonu" tabindex="4" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email"  value = "<?php
                                    if(isset($_SESSION['zp_email']))
                                    {
                                    echo $_SESSION['zp_email'];
                                    unset($_SESSION['zp_email']);
                                    }
                                    if(isset($_GET['email'])){
                                       echo $_GET['email']; 
                                       unset($_GET['email']);
                                    }
                                ?>" class="form-control input-lg" placeholder="Email Address" tabindex="5" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Hasło" tabindex="6" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Potwierdź Hasło" tabindex="7" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-3">
                            <span class="button-checkbox">
                                <button type="button" class="btn" data-color="info" tabindex="8">Zgoda</button>
                                <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                            </span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-9">
                             Zatwierdzając <strong class="label label-primary">REJESTRACJE</strong>, zgadzasz się na <a href="#" data-toggle="modal" data-target="#myModal" style = "color:blue">Regulamin</a> naszej strony oraz pliki cookies.
                        </div>
                    </div>
                    
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input type="submit" name="Zarejestruj" value="Zarejestruj" class="btn btn-primary btn-block btn-lg" tabindex="9"></div>
                        <div class="col-xs-12 col-md-6"><a href="logowanie.php" class="btn btn-success btn-block btn-lg" tabindex="10">Logowanie</a></div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tytuł okienka pop-up</h4>
                    </div>
                    <div class="modal-body">
                        <p>Zawartość okienka pop-up</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                        <button type="button" class="btn btn-primary">Zapisz zmiany</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fas fa-pizza"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">STRONA GŁÓWNA</a></li>
                    <li><a href="pizza.php">MENU</a></li>
                    <li><a href="about.php">KONTAKT</a></li>
                    <li><a href="logowanie.php">LOGOWANIE</a></li>
                    <?php
                    $count = 0;
                        if(isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                        }
                    ?>
                    <li><a href="card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count; ?>)</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
                <a href="#myPage" title="To Top">
                <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
                </a>
            </footer>
</body>
</html