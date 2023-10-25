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

            <main class="product_page">
    <div class="container_product_main">
        <div class="left_product">
            <p>KATEGORIE:</p><br><br>

            <?php
                $query = "SELECT DISTINCT PRODUCENT FROM produkty WHERE typ_p = 5";

                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    echo '<ul class="category" onclick="toggleList(\'producent\')">';
                    echo '<li>Producent';
                    echo '<ul class="sub-list" id="producent" class="hidden_list_element">';
                
                    while ($row = $result->fetch_assoc()) {
                        echo '<form method="post" action="jednorazowki.php">';
                        echo '<input type="hidden" name="producent" value="' . $row["PRODUCENT"] . '">';
                        echo '<button type="submit">' . $row["PRODUCENT"] . '</button>';
                        echo '</form>';
                    }
                
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                } else {
                    echo "Brak wyników z bazy danych.";
                }
            ?>

        </div>
        <div class="right_product">
            <p>PRODUKTY:</p>
            <div class="container_products_page">
                <section class="products">
                <?php

                    $products = mysqli_query($conn, "select * from produkty where typ_p = 5");
                    // Limit produktów na stronę
                    $per_page = 9;

                    // Strona (domyślnie 1)
                    $page = isset($_POST['page']) ? $_POST['page'] : 1;

                    // Oblicz ofset na podstawie strony
                    $offset = ($page - 1) * $per_page;

                    // Logika filtrowania na podstawie producenta
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["producent"])) {
                        // Pobierz producenta przesłanego za pomocą metody POST
                        $selectedProducent = $_POST["producent"];

                        // Wykonaj zapytanie do bazy danych, aby pobrać produkty wybranego producenta
                        $query = "SELECT * FROM produkty WHERE producent = ? AND typ_p=4";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $selectedProducent);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Umieść wyniki zapytania w tablicy $filteredProducts
                        while ($row = $result->fetch_assoc()) {
                            $filteredProducts[] = $row;
                        }
                    }

                    // Wykonaj zapytanie do bazy danych z uwzględnieniem limitu i ofsetu
                    $query = "SELECT * FROM produkty WHERE typ_p = 5";
                    $query .= empty($filteredProducts) ? "" : " AND producent = ?";
                    $query .= " LIMIT $per_page OFFSET $offset";

                    $stmt = $conn->prepare($query);

                    if (!empty($filteredProducts)) {
                        $stmt->bind_param("s", $selectedProducent);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<div class="product_photo"><img src="' . getAttachmentPath($row['id_p'], $conn) . '"></div>';
                        echo '<div class="product_description">' . $row['nazwa'] . '</div>';
                        echo '<div class="product_about">';
                        echo '<form method="post" action="product_description.php" class="short_form">';
                        echo '<input type="hidden" name="product_id" value="' . $row['id_p'] . '">';
                        echo '<button type="submit" name="open_description" class="product_about_button">Czytaj więcej</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
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
                </section>

                <div class="pagination">
                    <?php
                        if (isset($_POST["producent"])) {
                            $selectedProducent = $_POST["producent"];
                            $query = "SELECT COUNT(*) FROM produkty WHERE producent = ? AND typ_p = 5";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("s", $selectedProducent);
                            $stmt->execute();
                            $stmt->bind_result($categoryRecordCount);
                            $stmt->fetch();
                            $stmt->close();
                        } else {
                            $categoryRecordCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produkty WHERE typ_p = 5"));
                        }
                        
                        $total_pages = ceil($categoryRecordCount / $per_page);

                        echo '<div class="pages_number">';
                        echo '<p>Strona:</p>';
                        echo '</div>';
                        
                        echo '<div class="pages_number_list">';
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<form method="post" action="longfill.php">';
                            echo '<input type="hidden" name="page" value="' . $i . '">';
                            if (isset($_POST["producent"])) {
                                echo '<input type="hidden" name="producent" value="' . $selectedProducent . '">';
                            }
                            echo '<button type="submit">' . $i . '</button>';
                            echo '</form>';
                        }
                        echo '</div>';
                    ?>
            </div>
        </div>
    </div>
</main>

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