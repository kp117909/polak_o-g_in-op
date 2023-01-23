<?php
    require_once 'config.php'; 

    $polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);
    $resultaty = @$polaczenie->query("SELECT * FROM menu ORDER By id");
    $rowsNumber = mysqli_num_rows($resultaty);
    $ilosc = 0;
    if ($rowsNumber > 0){
    while ($pizza = $resultaty->fetch_assoc()) {
    $skladniczkimojekochane = "";
    $skladniki_cart = "";
    $procedura_skladniki = @$polaczenie->query("SELECT skladniki.nazwa FROM skladniki LEFT JOIN pizza_skladnik ON pizza_skladnik.id_skladnika = skladniki.id LEFT JOIN menu ON menu.id = pizza_skladnik.id_pizza WHERE menu.id = ".$pizza['id']."");
    while($nazwa_skladnikow = $procedura_skladniki->fetch_assoc()){
        $skladniki_cart = $skladniki_cart." ".$nazwa_skladnikow['nazwa'].",";
        $skladniczkimojekochane = $skladniczkimojekochane."<i style='color:#f0ad4e;' class='mdi mdi-flash'></i>".$nazwa_skladnikow['nazwa']."<i style='color:#f0ad4e;' class='mdi mdi-flash'></i></br></br>";
    }
    $ilosc++;
    if(!is_null($pizza['nazwa'])){
        echo ('
        <div class = "col-sm-3">
        <h1 class = "text-center" style = "color:black font-family:"Lato", sans-serif!important;">'.$pizza['nazwa'].'</h1>
        <div class = "panel panel-default text-center">
            <div class = "panel-heading">
                <h1><img src="'.$pizza['img'].'" style = "width:75%; height:75%;"></h1>
            </div>
            <div class = "panel-body">
                <p style = "font-size:20px;"><strong>'.$skladniczkimojekochane.'</strong></p>
            </div>
            <div class = "panel-footer">
                <h3>'.$pizza['cena'].' zł</h3>
                <h4>Sos Gratis</h4>
                <form action="../web/m_card.php" method="POST">
                <button type="submit" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" name="Add_To_Cart">Dodaj do koszyka</button>
                    <input type="hidden" name="nazwa" value="'.$pizza['nazwa'].'"/>
                    <input type="hidden" name="cena" value="'.$pizza['cena'].'"/>
                    <input type="hidden" name="img" value="'.$pizza['img'].'"/>
                    <input type="hidden" name="skladniki" value="'.$skladniki_cart.'"/>
                    
                </form>
            </div>
        </div>
    </div>');
    }
if($ilosc == 3){
    echo('
    <div class = "col-sm-3">
    <h1 class = "text-center" style ="color:#c54d26">Ulica Cie Wyjaśni</h1>
    <div class = "panel panel-default text-center">
        <div class = "panel-heading">
        <h1><img src="../png/oriental.png" style = "width:75%; height:75%;"></h1>
        </div>
        <div class = "panel-body">
            <p style = "font-size:20px;"><strong><i style="color:#f0ad4e;" class="mdi mdi-flash"></i>Sos<i style="color:#f0ad4e;" class="mdi mdi-flash"></i></strong><br><br>
            <strong><i style="color:#f0ad4e;" class="mdi mdi-flash"></i>Ser<i style="color:#f0ad4e;" class="mdi mdi-flash"></i></strong><br><br>
            <strong><i style="color:#f0ad4e;" class="mdi mdi-flash"></i>Własny Składnik<i style="color:#f0ad4e;" class="mdi mdi-flash"></i></strong><br><br>
            <strong><i style="color:#f0ad4e;" class="mdi mdi-flash"></i>Własny Składnik<i style="color:#f0ad4e;" class="mdi mdi-flash"></i></strong><br><br></p>
        </div>
        <div class = "panel-footer">
            <h3>19 zł</h3>
            <h4>Sos Gratis</h4>
            <a href="../web/creator.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Creator</a>
        </div>
    </div>
</div>');
}
}}
mysqli_close($polaczenie); 
?>