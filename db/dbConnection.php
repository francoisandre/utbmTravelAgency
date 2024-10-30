<?php

function getDatabase() {
   return new PDO("mysql:host=localhost;dbname=utbmTravelAgency;charset=utf8", "utbmTravelAgency", "utbm");
}

?>