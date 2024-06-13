<!-- Stripe JavaScript library -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <?php $scriptList = array('js/jquery3.3.js', 'js/Checkout.js', 'js/FillForm.js', 'js/StripeJava.js');
    include("header.php");?>


<main>
    <section id="clearCart"></section>

<!-- checkout form. on submit, posts to validateCheckout -->
    <form id="paymentFrm" action="validateCheckout.php" method="post" novalidate>
        <fieldset id ="cart"></fieldset>
            <div id="errors"></div>
        
        <fieldset id="deliveryFieldset">
            <!-- First section of form is delivery address etc. -->
            <legend>Delivery Details</legend>
            <?php
            $formNames = array('Name', 'Email', 'Address1', 'Address2', 'City',
                'Postcode');
            foreach ($formNames as $formName){
                if ($formName === 'Address1'){
                    $displayName = 'Address Line 1';
                } else if ($formName === 'Address2'){
                    $displayName = 'Address Line 2';
                } else {
                    $displayName = $formName;}

                if ($formName === 'Email'){ $type = 'email';} else {$type = 'text';}
                echo "<p><label for=$formName>$displayName</label>
                    <input type=$type name='$formName' id='$formName'"; if (isset($_SESSION[$formName])) {
                    $name = $_SESSION[$formName];
                     }
                $box = $formName; include('fillBox.php');

                echo"></p>";}?>


        </fieldset>
        <!--<fieldset>
            <h3>Unavailable option: Pay with bitcoin or litecoin. </h3>
            <p><strong>pay with bitcoin to bitcoin address:</strong></p>
            
            <p><strong>pay with litecoin to litecoin address:</strong></p>
        </fieldset>-->
        
        <!-- Next section has credit card details -->
        <fieldset id="paymentFieldset">
            <legend>Payment Details</legend>
            <p>
                <label for="cardType">Card type:</label>
                <select name="cardType" id="cardType">
                    <option value="visa">Visa</option>
                    <option value="mcard">Master Card</option>
                    <option value="amex">American Express</option>
                </select>
            </p>
            <p>
                <label for="card_num">Card number:</label>
                <input type="text" class="card-number" name="card_num" id="card_num"value="4242424242424242" autocomplete="off" maxlength="16" required <?php
                $box = 'cardNumber'; include('fillBox.php'); ?>
                >
            </p>
            <p>
                <label for="cardMonth">Expiry date:</label>
                <select name="exp_month" id="cardMonth" class="card-expiry-month">
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12" selected>12</option>
                </select>
                \ <select name="exp_year" id="cardYear" class="card-expiry-year">
                <option value="2022">2022</option>
                <option value="2023" selected>2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
            </select>
            </p>
            <p>
                <label for="cardValidation">CVC:</label>
                <input type="text" class="short card-cvc" maxlength="4" name="cvc" value="123" id="cardValidation" autocomplete="off" required <?php
                $box = 'cardValidation'; include('fillBox.php'); ?>
                >
            </p>
        </fieldset>
        <input id="payBtn" class='lightGreenButton'type="submit" value="Place Order" disabled>
    </form>
    <?php if (isset($_SESSION['orderError'])) {
        $orderError = $_SESSION['orderError'];
        echo "<article>$orderError</article>";
    } ?>
</main>

<footer>
    <?php include("footer.php"); ?>
</footer>