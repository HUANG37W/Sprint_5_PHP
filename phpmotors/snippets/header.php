<?php
if (isset($_SESSION['clientData']['clientFirstname'])) {
    $firstname = $_SESSION['clientData']['clientFirstname'];
};

$header = '<header id="header">

<img src="/phpmotors/images/site/logo.png" alt="PHP motors logo" id="header-img">';
if (isset($firstname)) {
    $header .= "<span id='header-welcome'><a href='/phpmotors/accounts/?action=Admin'>Welcome $firstname</a></span>";
};

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $header .=  '<a href="/phpmotors/accounts/?action=Logout" id="header-button">Log Out';
} else {
    $header .=  '<a href="/phpmotors/accounts/" id="header-button">My Account';
}
$header .= '</a>';
$header .= "<a id='search-icon' href='/phpmotors/?action=Search-page'><img src='/phpmotors/images/searchBtn.png' ></a></header>";