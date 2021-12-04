<?php



// var setup for connection, possibly move to .ini file in future
$conflex = "somewhereovertherainbow";$spindle = "niceTry";
$associative = "hahahaha";$lol = "hehehehe";

// Create connection
$conn = mysqli_connect($conflex, $spindle, $associative, $lol);

// check if connection successful
if (!$conn) {
    die("Connection failed! Unable to establish connection.");
}
if (isset($_POST['allSongs'])) {
    // perform query, prepare
    $result = $conn->prepare("SELECT * FROM song");
    $result->execute();

    // explicitly taking results from database and storing it in php's memory
    $songs = $result->get_result();
    $rows = [];

    /* now can iterate over content bc results stored into php memory while 
     * row comes from songs, fetching associatively, to expose each row in 
     * the query as an associative array */    
    while ($row = $songs->fetch_assoc()) {
      /* expose each row in the query as an associative array to gain access to
       * things such as row.col as "$row->col_name" ie $row.price */  
      $rows []= $row;
    }
    // echo results in compatible format for React Native client side to utilize
    echo json_encode($rows);

} elseif (isset($_POST['bpmAsc'])) {
    $result = $conn->prepare("SELECT * FROM bpm_asc");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
  }
  echo json_encode($rows);

} elseif (isset($_POST['bpmDesc'])) {
    $result = $conn->prepare("SELECT * FROM bpm_desc");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
}
// this one will need to obtain userID of logged in user as session var?
elseif (isset($_POST['cleanOnly'])) {
    $result = $conn->prepare("SELECT * FROM clean_music");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
} elseif (isset($_POST['remix'])) {
    // displays remix only songs
    $result = $conn->prepare("SELECT * FROM song WHERE remix=1");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
} elseif (isset($_POST['purchaseHist'])) {
    // displays songs bought by user - WIP user session var for obtaining usr ID?
    $result = $conn->prepare("SELECT * FROM purchase_hist WHERE usrID=5000");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
} elseif (isset($_POST['login'])) {
    // displays songs bought by user - WIP user session var for obtaining usr ID?
    $result = $conn->prepare("SELECT * FROM sodapop WHERE id=10");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
} elseif (isset($_POST['signup'])) {
    // displays songs bought by user - WIP user session var for obtaining usr ID?
    $result = $conn->prepare("SELECT * FROM sodapop WHERE id=10");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
}

else {
    $result = [];
    $result []= array("id" => 1, "myResponse" => "no special request, this will break my heart  \u{1F624}");
    echo json_encode($result);
}

?>
