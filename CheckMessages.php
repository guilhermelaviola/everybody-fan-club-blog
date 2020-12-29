<?php

require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

if (isset($_GET["id"])) {
    $SearchQueryParameter = $_GET["id"];
    global $ConnectingDB;
    $Admin = $_SESSION["AdminName"];
    $sql = "UPDATE messages SET status='ON', markedasreadby='$Admin' WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Message checked sucessfully!";
        Redirect_to("Messages.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
        Redirect_to("Messages.php");
    }
}
?>
