
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

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->
    </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div>
        <?php
            session_start();

            if(isset($_SESSION['rejestracja'])){
                echo $_SESSION['sukces'];
                unset($_SESSION['rejestracja']);
            }

            require_once 'config.php'; 
            
            $polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);

            if($polaczenie->connect_errno!=0)
            {
                echo "Erorr".$polaczenie->connect_errno . "Opis".$polaczenie->connect_error;
            }
            else{
                if(isset($_POST['Logowanie'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    $email = htmlentities($email, ENT_QUOTES, "UTF-8");

                    if ($result = @$polaczenie->query(sprintf("SELECT * FROM user WHERE email = '%s'",
                    mysqli_real_escape_string($polaczenie, $email))))
                    {
                        $users = $result->num_rows;
                        if($users>0)
                        {
                            $row = $result->fetch_assoc(); // Wkladanie do tablicy wartosci

                            if(password_verify($password, $row['password']))
                            {
                                $_SESSION['zalogowany'] = true;
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['display_name'] = $row['display_name'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['password'] = $row['password'];
                                $_SESSION['first_name'] = $row['first_name'];
                                $_SESSION['last_name'] = $row['last_name'];
                                $_SESSION['phonenumber'] = $row['phonenumber'];

                                $_SESSION['city'] = $row['city'];
                                $_SESSION['address'] = $row['address'];
                                $_SESSION['nr_zamieszkania'] = $row['nr_zamieszkania'];
                                $_SESSION['isadmin'] = $row['isadmin'];

                                unset($_SESSION['blad']);
                                $result->free_result();
                                header('Location: ../user_web/index_user.php');
                            }else
                            {
                                $_SESSION['blad'] = "<div class='alert alert-danger'>Nieprawidłowe dane</div>";
                                echo $_SESSION['blad'];
                                unset($_SESSION['blad']);
                            }
                        }else
                        {
                            $_SESSION['blad'] = "<div class='alert alert-danger'>Nieprawidłowe dane</div>";
                            echo $_SESSION['blad'];
                            unset($_SESSION['blad']);
                        }
                    }
                    $polaczenie->close();
                }
            }

        ?>
    </div>
   
    <div class="row" style = "margin-top:5%">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form action="logowanie.php" method="post">
                    <h2>Logowanie<small> THUNDER PIZZA</small></h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Hasło" tabindex="5" required>
                            </div>
                        </div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input type="submit" name="Logowanie" value="Logowanie" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                        <div class="col-xs-12 col-md-6"><a href="rejestracja.php" class="btn btn-success btn-block btn-lg">Rejestracja</a></div>
                    </div>
                </form>
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