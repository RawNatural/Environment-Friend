
<link type="text/css" rel="stylesheet" href="leaflet.css">
<link type="text/css" rel="stylesheet" href="contact.css">
<?php $scriptList = array('js/jquery3.3.js', './js/leaflet.js', './js/map.js');
include('header.php'); ?>


<main>
    <?php
    include('contactForm.php');
    ?>
</main>

<footer><?php include("footer.php"); ?>
</footer>

</body>
</html>