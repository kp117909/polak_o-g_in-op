<?php
    require_once '../web/config.php';
    if(isset($_POST['zapis_csv'])){
        $nazwapliku=$_POST['nazwa_pliku_csv'].'.csv';
        $resultaty = @$polaczenie->query("SELECT * FROM menu ORDER By id");
        $rowsNumber = mysqli_num_rows($resultaty);
        $ilosc = 0;
        if ($rowsNumber > 0){
            $data = [];
            while ($pizza = $resultaty->fetch_assoc()) {
                $skladniczkimojekochane = "";
                $skladniki_cart = "";
                $procedura_skladniki = @$polaczenie->query("SELECT skladniki.nazwa FROM skladniki LEFT JOIN pizza_skladnik ON pizza_skladnik.id_skladnika = skladniki.id LEFT JOIN menu ON menu.id = pizza_skladnik.id_pizza WHERE menu.id = ".$pizza['id']."");
                while($nazwa_skladnikow = $procedura_skladniki->fetch_assoc()){
                    $skladniki_cart = $skladniki_cart." ".$nazwa_skladnikow['nazwa']."";
                }
                if($pizza["nazwa"]!=null){
                    $data[] = $pizza["id"].",".$pizza["nazwa"]."," . $pizza["cena"]."," . $skladniki_cart.",";
                }
            }
        $fp = fopen($nazwapliku, 'w');
        foreach ( $data as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val, ";");
        }   
        fclose($fp); 
        echo" <script>
            window.location.href = '../admin/admin.php';
        </script>
        ";
    }
}
    if(isset($_POST['wczytaj_csv'])){
    $nazwapliku=$_POST['nazwa_pliku_csv'].'.csv';
    $row = 1;
    if (($handle = fopen($nazwapliku, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            for ($c=0; $c < $num; $c++) {
                foreach ( $data as $line ) {
                    $val = explode(";", $line); 
                    $sql="INSERT INTO skladniki(nazwa,cena) VALUES ('$val[0]','$val[1]')";
                    $polaczenie->query($sql);
                }
            }
        }
        echo" <script>
            window.location.href = '../admin/admin.php';
        </script>
        ";
        fclose($handle);
    }
    }
?>