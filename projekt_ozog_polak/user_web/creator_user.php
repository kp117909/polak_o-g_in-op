<?php
    session_start();


    if(!isset($_SESSION['zalogowany'])){
        header('Location: ../web/index.php');
        exit;
    }
    $count = 0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    };

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Thunder Pizza</title>
        <link rel="shortcut icon" href="../png/pizza.png"/>
        <meta charset="utf-8">
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
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->
      </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <div class="container" style = "margin-top: 5%;">
        <h3>Stwórz własną Pizze</h3>
                <div class="form-group">
                    <input type="text" name="filter" id="filter" class="form-control input-lg" placeholder="Wpisz nazwe składnika" tabindex="1">
                </div>
            <hr/>
            <table id="tabela">
            <?php
                    require_once '../web/config.php'; 
                    
                    $polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);
                    $resultaty = @$polaczenie->query("SELECT * FROM skladniki ORDER By nazwa");
                    $rowsNumber = mysqli_num_rows($resultaty);
                    $ilosc = 0;
                    if ($rowsNumber > 0){
                    while ($skladniki = $resultaty->fetch_assoc()) {
                    if ($ilosc == 0){
                        echo ("
                        <div class = 'col-sm-5 col-lg-4' style = 'float:right; margin-right:0%; margin-bottom:0%;'>
                        <div class = 'panel panel-default text-center'>
                            <div class = 'panel-heading'>
                                <h1>Ulica Cie Wyjaśni<img src='../png/oriental.png' style = 'width:75%; height:75%;'></h1>
                            </div>
                            <div class = 'panel-body'>
                                <p><strong>Ser</strong></p>
                                <p><strong>Sos</strong></p>
                                <p id ='skladnik'><strong></strong></p>
                            </div>
                            <div class = 'panel-footer'>
                                <h3><p id = 'cena'>19 zł</p></h3>
                                <h4>Sos Gratis</h4>
                                <form>
                                    <button type='submit' onclick= 'info()' class='btn btn-secondary btn-lg active' role='button' aria-pressed='true' name='AddCart'>Dodaj do koszyka</button>
                                </form>   
                            </div>
                        </div>
                    </div>");
                    }
                    $ilosc++;
                    echo ("
                    <tr>
                        <td>
                            <div class='[ form-group ]'>
                                <input type='checkbox' name='components' id='fancy-checkbox-".$skladniki['nazwa']."' value=".$skladniki['nazwa']. "|" .$skladniki['cena']."' onclick ='start(this.value)'  autocomplete='off'/>
                                <div class='[ btn-group ]'>
                                    <label for='fancy-checkbox-".$skladniki['nazwa']."' class='[ btn btn-warning ]'>
                                        <span class='[ glyphicon glyphicon-ok ]'></span>
                                        <span> </span>
                                    </label>
                                    <label for='fancy-checkbox-".$skladniki['nazwa']."' class='[ btn btn-default active ]'>
                                        ".$skladniki['nazwa']."
                                    </label>
                                    <label for='fancy-checkbox-".$skladniki['nazwa']."' class='[ btn btn-warning active ]'>
                                        ".$skladniki['cena']." zł
                                    </label>
                                </div>
                            </div>
                        </td>
                    </tr>");
                }}
            ?>
        </table>


    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index_user.php"><i class="fas fa-pizza"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index_user.php">STRONA GŁÓWNA</a></li>
                    <li><a href="pizza_user.php">MENU</a></li>
                    <li><a href="about_user.php">KONTAKT</a></li>
                    <li><a href="user.php" style = "text-transform: uppercase"><?php echo $_SESSION['display_name'];?></a></li>
                    <li><a href="../web/card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count;?>)</a></li>
                    <li><a href="../web/logout.php" style = "text-transform: uppercase">WYLOGUJ SIĘ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
        <a href="" title="Thunder Pizza">
        <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>

    <script type="text/javascript">
            function start(e){
                var cenazhtml = document.getElementById("cena").innerHTML;
                var liczba = cenazhtml.split(' ');
                var zmienna = parseFloat(liczba[0]);
                var slowo = e.split('|');
                var cena = parseFloat(slowo[1]);
                if ($('input#fancy-checkbox-'+slowo[0]).is(':checked')){
                    zmienna = zmienna + cena;
                    document.getElementById("cena").innerHTML = zmienna + " zł";
                }
                else{
                    zmienna = zmienna - cena;
                    document.getElementById("cena").innerHTML = zmienna + " zł";
                }
        }
        function info(){
            var price_html = document.getElementById("cena").innerHTML;
            var number = price_html.split(' ');
            var price = parseFloat(number[0]);
            var components = document.getElementsByName("components")
            var checked_components = "";
            for(var checkbox_checked of components){
                if(checkbox_checked.checked){
                    var name_component = checkbox_checked.value.split('|');
                    var name = name_component[0];
                    checked_components = checked_components + name + ", ";
                }
            }
            $.ajax({
                url: "../web/m_card.php",
                type: 'GET',
                data: {
                    creator: true,
                    cena : price,
                    skladniki: checked_components,
                    nazwa: "Własna",
                },
            });
        }
        function change(){
            var selectBox = document.getElementById("inlineFormCustomSelect");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var cenazhtml = document.getElementById("cena").innerHTML;
            var liczba = cenazhtml.split(' ');
            var zmienna = parseFloat(liczba[0]);
            var cena = parseFloat(selectedValue);
                zmienna = zmienna + cena;
                document.getElementById("cena").innerHTML = zmienna + " zł";
        }
        var $row = $('#tabela tr');
        $('#filter').keyup(function() {
                var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
                    reg = RegExp(val, 'i'),
                    text;
                
                $row.show().filter(function() {
                    text = $(this).text().replace(/\s+/g, ' ');
                    return !reg.test(text);
                }).hide();
            });
</script>

</body>
</html