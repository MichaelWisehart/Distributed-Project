<?php
// JG
// var setup for connection, possibly move to .ini file in future
$conflex = "somewhereovertherainbow";$spindle = "niceTry";
$associative = "hahahaha";$lol = "hehehehe";

// Create connection
$conn = mysqli_connect($servername, $dbuser, $password, $database);

// check if connection successful
if (!$conn) {
    die("Connection failed! Unable to establish connection.");
}
// show all songs
if (isset($_POST['allSongs'])) {
    header('Content-type: application/json');
    unset($_POST['allSongs']);
    // perform query, protect from sql injection
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

} 
// if user sorts all available music in ascending order by beats per minute
elseif (isset($_POST['bpmAsc'])) {
    header('Content-type: application/json');
    unset($_POST['bpmAsc']);
    $result = $conn->prepare("SELECT * FROM bpm_asc");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
  }
  echo json_encode($rows);

} 
// if user sorts all available music in DESCending order by beats per minuteer
elseif (isset($_POST['bpmDesc'])) {
    header('Content-type: application/json');
    unset($_POST['bpmDesc']);
    $result = $conn->prepare("SELECT * FROM bpm_desc");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
    
}
// if user selects to view only "clean" songs
elseif (isset($_POST['cleanOnly'])) {
    header('Content-type: application/json');
    unset($_POST['cleanOnly']);
    $result = $conn->prepare("SELECT * FROM clean_music");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);

} 
// if user selects to view remixed songs
elseif (isset($_POST['remix'])) {
    header('Content-type: application/json');
    unset($_POST['remix']);
    // displays remix only songs, denoted in database by tinyint of 1 for true
    $result = $conn->prepare("SELECT * FROM song WHERE remix=1");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);

} 
// obtains user ID from React Native client, to view purchase history
elseif (isset($_POST['purchaseHist'])) {
    header('Content-type: application/json');
    unset($_POST['purchaseHist']);
    
    // only will use $_POST's user_id
    //$userID = $_POST["user_id"];
    $userID = "5036"; // for debugging

    // *for demo*
    // checks if user_id was sent in POST request
    if ($userID == null) {
        //echo json_encode($userID);
        echo json_encode(array("error" => "no user_id received to view purhcase history"));
        return;
    }

    //echo json_encode($userID);
    $result = $conn->prepare("SELECT * FROM purchase_hist WHERE usrID=$userID");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);
    
} 
// for user to add to cart (on database)
elseif(isset($_POST['addToCart'])) {
    header('Content-type: application/json');
    unset($_POST['addToCart']);

    // obtain from React Native
    $userID = $_POST["user_id"];
    $songID = $_POST["song_id"];

    if ($userID == null || $songID == null) {
        echo json_encode(array("error" => "no user_id or song_id received for cart add."));
        return;
    }

    $add2cart = $conn->prepare("CALL addCart(?, ?)");
    $add2cart->bind_param("ii", $userID, $songID);
    $add2cart->execute();

} 
// for user to remove song from cart
elseif(isset($_POST['removeFromCart'])) {
    header('Content-type: application/json');
    unset($_POST['removeFromCart']);
    
    // obtain from React Native
    $userID = $_POST["user_id"];
    $songID = $_POST["song_id"];

    if ($userID == null || $songID == null) {
        echo json_encode(array("error" => "no user_id or song_id received to remove from cart."));
        return;
    }

    $add2cart = $conn->prepare("CALL removeCart(?, ?)");
    $add2cart->bind_param("ii", $userID, $songID);
    $add2cart->execute();

} 
// for user to view their current cart
elseif (isset($_POST['viewCart'])) {
    header('Content-type: application/json');
    unset($_POST['viewCart']);

    // obtain from React Native
    //$userID = $_POST["user_id"]; for testing purposes using testuser
    $userID = "5036";

    if ($userID == null) {
        echo json_encode(array("error" => "no user_id received to view cart"));
        return;
    }

    $result = $conn->prepare("SELECT * FROM view_cart WHERE usrID=$userID");
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);

}

elseif(isset($_POST['checkout'])) {
    // user_id (db), session_id(php)
    header('Content-type: application/json');
    unset($_POST['checkout']);

    // MOST RECENT these came from the form from React Native Client
    //$userID = $_POST['user_id'];
    $userID = "5036";

    if ($userID == null) {
        //echo json_encode($userID);
        echo json_encode(array("error" => "no user ID to checkout"));
        return;
    }

    // createAccount gonna be a prepared statement, make a prepared call to a stored
    // procedure stored procedure accepts parameters in order: uname, email, pword
    $createAccount = $conn->prepare("CALL checkout(?)");

    // bind parameters, in a variatic function, first arg must be a string with
    // datatype for each placeholder "sss" for three strings, can use 'i' if int
    // ect; then following params in the order
    $createAccount->bind_param("s", $userID);
    // now execute prepared stament
    if($createAccount->execute()){
        // echo json_encode(array("testmssg" => "testing123")); // for debugging
        // binding results to local variables so can fetch them and see if null
        //mysqli_stmt_bind_result($createAccount, $res_id, $res_error);
        $createAccount->fetch();

    } else {
        echo json_encode(array("error" => "an error has occurred!"));
    }

    //return JSON
    echo json_encode(array("success" => "you have checked out!"));

}
/*
// unfinished
elseif(isset($_POST['subscribe']) {
    header('Content-type: application/json');
    unset($_POST['subscribe']);

     // obtain from React Native
     //$userID = $_POST["user_id"];
     $userID = "5011";
     $subType = '1';
 
     if ($userID == null) {
         //echo json_encode($userID);
         echo json_encode(array("error" => "no user_id received to view Subscription."));
         return;
     }
 
     $result = $conn->prepare("CALL subscribe(?, ?)");
     $result = bind_param("ii", $userID, $subType);
     $result->execute();
     
     //echo json_encode($rows);
}*/
// for the user to view their subscription type (call procedure, bind, display))
elseif (isset($_POST['viewSub'])) {
    header('Content-type: application/json');
    unset($_POST['viewSub']);

    // obtain from React Native
    $userID = $_POST["user_id"];
    //$userID = "5011";
    //$userID = "5000";

    if ($userID == null || $songID == null) {
        //echo json_encode($userID);
        echo json_encode(array("error" => "no user_id received to view Subscription."));
        return;
    }

    $result = $conn->prepare("SELECT * from user_sub WHERE usrID = $userID");
    //$result = bind_param("i", $userID);
    $result->execute();
    $songs = $result->get_result();

    $rows = [];
    while ($row = $songs->fetch_assoc()) {
        $rows []= $row;
    }
    echo json_encode($rows);

} 
// for user to log in THIS IS A W.I.P.
elseif (isset($_POST['login'])) {
    header('Content-type: application/json');
    unset($_POST['login']);

    // MOST RECENT these came from the form from React Native Client
    //$username = $_POST['username'];
    
    // ommited

    $validation = $conn->prepare("SELECT * FROM user WHERE username=?");
    $validation->bind_param("s", $username);
    $validation->execute();
    //mysqli_stmt_bind_result($validation, $res_id, $res_user, $res_password);
    mysqli_stmt_bind_result($validation, $retID, $retUsername, $retEmail, $retPass, $payment);
    //mysqli_stmt_bind_result($validation, $userID);

    // fetching data, may moveinto conditional
    $fetched = $validation->fetch();
    $genErrMsg = "Invalid username and/or password";

    if($fetched && ($hashed==$retPass)) {
        session_start();
        session_regenerate_id();
        
        $_SESSION["userId"] = $retID;
        $_SESSION["username"] = $retUsername;

        $validation->close(); // what is being closed

        echo json_encode(array("userId" => $retID, "username" => $retUsername,
            "session_id" => session_id()));
    }
    else {
        echo json_encode(array("error" => $genErrMsg));
    }
} 
// for the user to view their subscription type (call procedure, bind, display))
elseif (isset($_POST['logout'])) {
    header('Content-type: application/json');
    unset($_POST['logout']);
    $userID = "5031";

    // determine if user_ID or sesh ID was sent
    if (!isset($_POST["session_id"]) || !isset($_POST["user_id"])) {
        echo json_encode(array("error" => "no session_id or user_id"));
        return;
    }
    // set current session as the session denoted by sent sesh ID
    session_id($_POST["session_id"]);
    session_start();

    //  prevent curls, determing proper user and session ID
    if ($_POST["user_id"] != $_SESSION["user_id"]) {
        echo json_encode(array("error" => "user_id mismatch"));
        return;
    }

    session_destroy();
    echo json_encode(array("message" => "User logged out"));

} 
// for user to create an account, requires React Native client to send proper data
elseif (isset($_POST['createAccount'])) {
    header('Content-type: application/json');
    unset($_POST['createAccount']);

    // MOST RECENT these came from the form from React Native Client
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($username == null || $password == null || $email == null) {
        //echo json_encode($userID);
        echo json_encode(array("error" => "no username, email, or password sent."));
        return;
    }

    // createAccount gonna be a prepared statement, make a prepared call to a stored
    // procedure stored procedure accepts parameters in order: uname, email, pword
    $createAccount = $conn->prepare("CALL createAccount(?, ?, ?)");

    // bind parameters, in a variatic function, first arg must be a string with
    // datatype for each placeholder "sss" for three strings, can use 'i' if int
    // ect; then following params in the order
    $createAccount->bind_param("sss", $username, $email, $password);
    // now execute prepared stament
    if($createAccount->execute()){
        // echo json_encode(array("testmssg" => "testing123")); // for debugging
        // binding results to local variables so can fetch them and see if null
        mysqli_stmt_bind_result($createAccount, $res_id, $res_error);
        $createAccount->fetch();

        // do we have successful registratation, check for duplicate email/username
        if (is_null($res_id)) {
            // error code for duplicate user name or email
            echo json_encode(array("error" => $res_error));
            return;
        }
        // all is well, registration worked and you were given a user ID
        // 
        else {
            echo json_encode(array("user_id" => $res_id));
            //echo json_encode(array("username" => $res_id)); // debuggin, remove if not needed
            return;
        }
    } else {
        echo json_encode(array("error" => "an error has occurred!"));
    }
}

else {
    // M&M can send anything else like 'aha' to see if they can catch this returned array
    $result = [];
    $result []= array("id" => 1, "myResponse" => "no special request, this will break my heart");
    echo json_encode($result);
}
?>
