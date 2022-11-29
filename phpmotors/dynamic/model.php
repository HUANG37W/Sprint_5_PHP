<?php

function getVehicleInfo($id = 0)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    if ($id == 0) {
        $sql = "SELECT invId, invMake, invModel, invPrice FROM inventory ";
    } else {
        $sql = "SELECT invId, invMake, invModel, invPrice FROM inventory WHERE invId=$id";
    }

    // The next line creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $classifications variable
    $vehicleInfo = $stmt->fetchAll();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    // The next line sends the array of data back to where the function
    // was called (this should be the controller)
    return $vehicleInfo;
}