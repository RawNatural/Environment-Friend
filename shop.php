<?php

function addProduct($productName, $images, $price, $description, $anythingElse) {
    echo "<div class='product' id='$productName'>";
    $title = str_replace('_', ' ', $productName);
    echo "<h2 class='itemTitle'>$title</h2>";
    $count = count($images);
    for ($i = 0; $i < count($images); $i++) {
        echo "<img src='$images[$i]' ";
        if ($i === 0){
            echo "class='mainImg'";} else
            if ($i === count($images)-1){
                echo "class='lastImg'";}
            else {
            echo "class='otherImgs'";
        }

        echo ">";
    }
    echo "<div class='otherStuff'>";
    echo '<div class="priceDiv">$';echo "<span class='price'>$price</span></div>";
    echo '<div class="buttons">';
    echo "<button name='add($productName)ToCart' class='buyButton' role='button'>Add To Cart</button>";
    echo "<button name='buy$productName' id='buy$productName' value='Buy Now' class='buyButton buyNowButton' role='button' onclick='window.location.href=\"checkout.php\"'>Buy Now</button>"; echo "</div>";
    echo "<article class='description'>$description</article>";

    echo "$anythingElse";
    echo "</div>";
    echo "</div>";
    echo "<br><br>";
}

?>


<?php $scriptList = array('js/jquery3.3.js', 'js/ShowHide.js', 'js/Cart.js', 'js/Reviews.js', 'js/ProductPhotoChange.js', 'js/cleaningTips.js');
    include("header.php"); include("addReviewForm.php");?>

<main>

    <h1>Shop</h1>
    <p id="pricesAUD">All Prices are in AUD</p>
    <!--<h2 id="freeShipping">Free Shipping on all orders</h2>-->
   <!-- <p id="supportStatement"><b>Please support us by adding some environmentally friendly products to your collection.<br><br>Free Shipping on all orders.</b></p>

-->

    <?php
    $productName = "Bamboo_Utensils_Travel_Pack";
    $images = array("images/utensilsCamo.jpg","images/utensilsMain.jpg", "images/utensilsPurple.jpg", "images/utensilsCamo.jpg");
    $price = 12.99;
    $description = "<p><strong>Utensils on the go</strong></p><p>Store easily, and fold out to eat.</p><p>Strong, sturdy, and easy to wash.</p>";

    addProduct($productName, $images, $price, $description, "");
    ?>


    <?php
    $productName = "Bamboo_Drinking_Straws";
    $images = array("images/BambooStrawsMain.jpg", "images/BambooStrawsMain.jpg", "images/BambooStrawsAndBrush.jpg", "images/strawsEnds.jpeg");
    $price = 9.99;
    $description = "<p><strong>Get in now on the new trend!</strong></p>
        <p>Bamboo straws feel and look spectacular. Help <strong>get rid of the millions of plastic straws</strong> that are polluting our oceans and land.</p>
        <p>Our bamboo straws are <strong>durable</strong> and <strong>easy to store</strong>. Take them with you wherever you go so that you never need to use another plastic straw.</p>
        <p>Our straws are completely Eco-Friendly! They are <strong>100% Biodegradable</strong> and <strong>Compostable</strong>; their components will break down into smaller particles and nutrients when left in the environment.</p>
        <p>They can be <strong>reused</strong> many times and will <strong>last several months</strong> if cared for.</p>";
    $anythingElse = "<div id='cleaningTips'><h4>Cleaning Tips</h4></div>
<p>Length: 19.5cm. Inner diameter: 4-5mm. </p>";

    addProduct($productName, $images, $price, $description, $anythingElse);

    ?>



<?php
$productName= "Bamboo_Toothbrush";
$images = array("images/toothbrushMain.jpg", "images/toothbrushMain.jpg");
$price = 3.99;
$description = "<p>Brush your teeth with an environmentally friendly toothbrush.</p><p>With charcoal-infused brushes to help remove stains and leave your teeth whiter than ever</p>";

addProduct($productName, $images, $price, $description, "");
?>


</main>


        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>