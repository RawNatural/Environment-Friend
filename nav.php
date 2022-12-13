<nav><ul>

        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);

        if ($currentPage === 'index.php') { echo "<li class='lightGreenButton'>Home</li>";
        } else {
            echo " <a href='index.php'><li class='lightGreenButton'>Home</li></a>";
        }
        if ($currentPage === 'aboutUs.php') { echo "<li class='lightGreenButton'>About</li>";
        } else {
            echo "<a href='aboutUs.php'><li class='lightGreenButton'>About</li></a>";
        }
        if ($currentPage === 'shop.php') { echo "<li class='lightGreenButton'>Shop</li>";
        } else {
            echo "<a href='shop.php'><li class='lightGreenButton'>Shop</li></a>";
        }
        if ($currentPage === 'contact.php') { echo "<li class='lightGreenButton'>Contact</li>";
        } else {
            echo "<a href='contact.php'><li class='lightGreenButton'>Contact</li></a>";
        }
        if ($currentPage === 'checkout.php') { echo "<li class='lightGreenButton' id='cartNav'>Cart</li>";
        } else {
            echo "<a href='checkout.php'><li class='lightGreenButton' id='cartNav'>Cart</li></a>";
        }
        if (isset($_SESSION['authenticatedUser'])){
            if ($currentPage === 'orders.php') { echo "<li class='lightGreenButton'>Orders</li>";
            } else {
                echo "<a href='orders.php'><li class='lightGreenButton'>Orders</li></a>";
            }
        }

        ?>
    </ul></nav>