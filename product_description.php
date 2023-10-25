<?php
include("path.php");
include("app/database/connect.php");
$products = array();


$filteredProducts = array();
/*
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["producent"])) {
    // Pobierz producenta przesłanego za pomocą metody POST
    $selectedProducent = $_POST["producent"];

    // Wykonaj zapytanie do bazy danych, aby pobrać produkty wybranego producenta
    $query = "SELECT * FROM longfille WHERE producent = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedProducent);
    $stmt->execute();
    $result = $stmt->get_result();

    // Umieść wyniki zapytania w tablicy $filteredProducts
    while ($row = $result->fetch_assoc()) {
        $filteredProducts[] = $row;
    }
}*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PUFF&STUFF - VAPESHOP Z PASJI</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/style_index.css">
        <link rel="stylesheet" href="styles/style_products.css">

        <!-- SCRIPTS -->
        <script src="https://kit.fontawesome.com/c42d1cc7c1.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="scripts/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="assets/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="assets/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
    </head>

    <body>
        
            <header class="header">
                <div class="header_content">
                    <ul>
                        <li><a href="#">PRODUKTY</a></li>
                        <li><a href="#">PROMOCJE</a></li>
                        <a href="http://localhost/demo/wielki_projekt/VAPESHOP"><img src="assets/logo_green.png" width="350px"></a>
                        <li><a href="#">SKLEPY</a></li>
                        <li><a href="#">KONTAKT</a></li>
                    </ul>
                </div>
            </header>
            
            
            <nav class="nav">
                <div class="item_menu">
                <ul>
                        <a href="liquid.php"><li>LIQUIDY</li></a>
                        <a href="longfill.php"><li>LONGFILLE</li></a>
                        <a href="bazy.php"><li>BAZY</li></a>
                        <a href="sprzety.php"><li>E-PAPIEROSY</li></a>
                        <a href="jednorazowki.php"><li>JEDNORAZÓWKI</li></a>
                        <a href="grzalki.php"><li>GRZAŁKI</li></a>
                        <a href="akcesoria.php"><li>AKCESORIA</li></a>
                    </ul>
                </div>
            </nav>

            <div class="navbar_main_mobile menu_hamburger_close" onclick="show_hamburger_list(); click_whole_box_hamburger()">
                <div class="menu_hamburger_main">
                    <svg class="ham hamRotate ham4" viewBox="0 0 100 100" width="45">
                    <path
                            class="line top"
                            d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                    <path
                            class="line middle"
                            d="m 70,50 h -40" />
                    <path
                            class="line bottom"
                            d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
                    </svg>
                    <span class="span_menu">MENU</span>
                    <div id="myLinks" class="wysuwane_menu_duze" style="display:none;">
                        <a href="liquid.php"><li>LIQUIDY</li></a>
                        <a href="longfill.php"><li>LONGFILLE</li></a>
                        <a href="bazy.php"><li>BAZY</li></a>
                        <a href="sprzety.php"><li>E-PAPIEROSY</li></a>
                        <a href="jednorazowki.php"><li>JEDNORAZÓWKI</li></a>
                        <a href="grzalki.php"><li>GRZAŁKI</li></a>
                        <a href="akcesoria.php"><li>AKCESORIA</li></a>
                    </div>
                </div>
            </div>


            

            <?php

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Pobierz szczegóły produktu na podstawie ID
    $query = "SELECT * FROM produkty WHERE id_p = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Wyświetl szczegóły produktu
        
        echo '<div class="products_about_container_desc">';

        ?>

        <?php
            echo '<div class="tresc_container">';
                echo '<div class="photo_product_about"><img src="' . getAttachmentPath($product_id, $conn) . '"></div>';

                    echo '<div class="container_product_about">';
                        echo '<div class="title_product_about"><h1>' . $product['nazwa'] . '</h1></div>';
                        echo '<div class="description_product_about"><p>' . $product['opis'] . '</p></div>';
                        echo '<div class="price_product_about"><p>' . $product['cena'] . ' zł</p></div>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
                } else {
                    echo "Brak produktu o podanym ID.";
                }

            } else {
                echo "Nieprawidłowe ID produktu.";
            }

            function getAttachmentPath($productId, $conn) {
                $attachmentPath = "Nie udało się załadować zdjęcia."; // Domyślna ścieżka w przypadku braku załącznika

                // Zapytanie SQL, które pobiera ścieżkę do załącznika na podstawie id produktu
                $query = "SELECT sciezkazdjecia FROM załączniki WHERE id_p = ? LIMIT 1";

                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $productId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $attachmentPath = $row['sciezkazdjecia'];
                }

                return $attachmentPath;
            }


            ?>
            <?php

            $typ_p = $_POST['typ_p'];
            if ($typ_p == 2){
                echo '<section class="rozrabianie_liquidu_tabela">';
                    echo '<p>PROPORCJE ROZRABIANIA LONGFILLA</p>';
                    echo '<div class="podzial_tab_zwykle">';
                        echo '<div class="mocowki">';
                            echo '<h5>DLA ZWYKŁYCH MOCÓWEK:</h5>';
                            echo '<h6>Aby osiągnąć 0mg/ml dodaj 50ml bazy 0mg</h6>';
                            echo '<h6>Aby osiągnąć 3mg/ml dodaj 40ml bazy 0mg oraz 1 shot 18mg/ml</h6>';
                            echo '<h6>Aby osiągnąć 6mg/ml dodaj 30ml bazy 0mg oraz 2 shoty 18mg/ml</h6>';
                            echo '<h6>Aby osiągnąć 9mg/ml dodaj 20ml bazy 0mg oraz 3 shoty 18mg/ml</h6>';
                            echo '<h6>Aby osiągnąć 12mg/ml dodaj 10ml bazy 0mg oraz 4 shoty 18mg/ml</h6>';
                            echo '<h6>Aby osiągnąć 15mg/ml dodaj 5 shotów bazy 18mg/ml</h6>';
                        echo '</div>';
                        echo '<div class="sole">';
                            echo '<h5 id="tabshot_margin">DLA TABLETEK TABSHOT:</h5>';
                            echo '<h6>Aby osiągnąć 0mg/ml dodaj 50ml bazy 0mg</h6>';
                            echo '<h6>Aby osiągnąć 4mg/ml dodaj do bazy 0mg 1 tabletkę TABSHOT</h6>';
                            echo '<h6>Aby osiągnąć 7mg/ml dodaj do bazy 0mg 2 tabletki TABSHOT</h6>';
                            echo '<h6>Aby osiągnąć 14mg/ml dodaj do bazy 0mg 3 tabletki TABSHOT</h6>';
                            echo '<h6>Aby osiągnąć 18mg/ml dodaj do bazy 0mg 5 tabletek TABSHOT</h6>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            } else {

            }
            ?>



            

            <footer class="footer">
                <div class="center_footer">
                    <div class="grid_footer">
                        <div class="text_footer">
                            <h2>KONTAKT</h2>
                            <p>PUFF & STUFF<br><br>
                                ul. nazwa<br>
                                kod Warszawa<br>
                                woj. mazowieckie<br><br>
                                Kontakt: +48 574 593 700<br>
                                Kontakt biznesowy: +48 577 585 739<br>
                                <a href="mailto:email_biznesowy@gmail.com">Email: email_biznesowy@gmail.com</a></p>
                        </div>
            
                        
                        <a href="#"><img src="assets/logo_green.png" alt="logo szkoły"></a>
                        <p class="center_footer_p">Copyright ©2023 - PUFF & STUFF Warszawa.<br>
                        Wykonanie: <a href="https://linktr.ee/tarusiek">Michał Tarka.</a></p>
                    </div>
                </div>
            </footer>


    </body>
</html>