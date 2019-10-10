<?php
include_once("core/init.inc.php");
include("core/events.php");
include("core/users.php");

if(!isset($_SESSION["userId"])){
    $_SESSION["userId"] = $_GET["u"];
}

$users = Users::getInstance();
$events = Events::getInstance();

// get user accroding to user_id from url
$user = getUserfromURL($users, $_SESSION["userId"]);

// variables whered data from session variables will be stored
$userName = $user[0];

// control if session variables were set
if(isset($_SESSION["userName"])){
    $userName = $_SESSION["userName"];
}
else{
    $_SESSION["userName"] = $userName;
}

// new instance of users used to show subscribed users and get userId
$userId = $users->getUserId();
$allUsers = $users->getAllUsers();

// new instance of events
//$subscribedEvents = $events->getSubscribedEvents($userId[0]);   // to print subscribed events of logged user
//$eventsRows = $events->getEvents();                             // to print offer of all events
// eventRows -> event_id, name, date_time, place, description, participants_max_num
?>

<!-- WELCOME PAGE -->
<html>

    <head>
        <!-- styling -->
        <PHP><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></PHP>
        <PHP><link rel="stylesheet" type="text/css" href="css/style.css"><PHP>
    </head>

    <body>
        <div class="container-fluid">

            <div class="row">

                <div class="user">
                    <div class="row">
                        <div class="col">
                            <h4>Welcome <?php echo $_SESSION["userName"]; ?></h4>
                            <p><?php echo $_SESSION["userEmail"]; ?></p>
                        </div>
                        <div class="col">
                            <form class="" action="core/forms/logout_handler.php" method="post">
                                <input class="logout-btn btn btn-info" type="submit" name="logout" value="Log out">
                            </form>
                        </div>
                    </div>

                    <div class="adminSection">
                        <?php
                        // only admin has userRole set to 1
                        if($_SESSION["userRole"] == 1){
                            // then print admin section
                            printAdminSection($eventsRows, $allUsers);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h4>Subscribed events</h4>
                            <?php
                            // print events that are subscribed by user
                            printSubscribedEvents($subscribedEvents);
                            ?>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="events">
                        <?php

                        // go over the $rows array and print the fields. The fields are accessed via array indexes.
                        foreach($eventsRows as $eventRow) {
                            // find all users in DB for this event
                            $subscribedUsers = $users->getSubscribedUsers($eventRow[0]);

                            // check if user is already subscribed (is in DB subscription)
                            // the result used for buttons Subscribe / Unsubscribe
                            $userSubscription = checkSubscription($subscribedUsers, $userId);

                            // print event post
                            printEventPost($eventRow, $subscribedUsers, $userSubscription, $userId);
                        }
                        ?>
                </div>

            </div>

        </div>

        <PHP><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script><PHP>
        <PHP><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script><PHP>
        <PHP><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><PHP>

    </body>
</html>

<!-- ////////////// -->
<!-- HELP FUNCTIONS -->
<!-- ////////////// -->

<?php

function checkSubscription($subscribedUsers, $userId){

    foreach ($subscribedUsers as $subscribedUser) {

        if($subscribedUser[1] == $userId[0]){
            return true;
        }
    }
    return false;
}

?>

<<?php

function printEventPost($eventRow, $subscribedUsers, $userSubscription, $userId){

    // showing free places accroding to what admin insert into form minus number of people that are going to this event
    $freePlaces = calculateFreePlaces($eventRow, $subscribedUsers);

    echo "<div id='event'>";

        echo "<div class='row'>";
            echo "<div class='col-8'>";
                echo "<h5>$eventRow[1]</h5>"; // name of event
                echo "<p>$eventRow[2]</p>"; // date
            echo "</div>";
            echo "<div class='event-buttons col-4'>";

                    // check if user is subscribed to event, if yes, only unsubscribe button is shown
                    if(!$userSubscription){

                        if($freePlaces > 0 || $freePlaces == UNLIMITED_PLACES){
                            echo "<form action='core/forms/subscription_handler.php' method='post'>";
                                echo "<input type='hidden' name='event_id' value='$eventRow[0]'/>";
                                echo "<input type='hidden' name='user_id' value='$userId[0]'/>";
                                echo "<input id='subscribe-btn' class='btn btn-info' type='submit' name='subscribe' value='Subscribe'/>";
                            echo "</form>";
                        }
                    }
                    else{
                        echo "<form action='core/forms/subscription_handler.php' method='post'>";
                            echo "<input type='hidden' name='event_id' value='$eventRow[0]'/>";
                            echo "<input type='hidden' name='user_id' value='$userId[0]'/>";
                            echo "<input id='unsubscribe-btn' class='btn btn-info' type='submit' name='unsubscribe' value='Unsubscribe'/>";
                        echo "</form>";
                    }

            echo "</div>";
        echo "</div>";
        echo "<div class='row'>";
            echo "<div class='col'>";

                echo "<p>$eventRow[3]<p>"; // place
                echo "<p>$eventRow[4]<p>"; // description

                if($freePlaces == UNLIMITED_PLACES){
                    echo "<p> Unlimited free places</p>";
                }
                else{
                    echo "<p>Free places: $freePlaces</p>";
                }
                // show all users subscribed to this event
                $eventPost = "eventPost$eventRow[0]";
                echo "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#$eventPost'>
                        Show people
                     </button>
                     <div id='$eventPost' class='collapse'>";
                        foreach($subscribedUsers as $subscribedUser) {
                            echo "$subscribedUser[0]";
                            echo "<br>";
                        }
                    echo "</div>";

                echo "</div>";

        echo "</div>";

    echo "</div>";

}

?>

<?php

function printAdminSection($eventsRows, $allUsers){

    echo "<div class='row'>";

        echo "<div class='col'>";
            echo "<button type='button' class='admin-btn btn btn-info' data-toggle='collapse' data-target='#addEvent'>
                Add Event
            </button>";
            echo "<div id='addEvent' class='collapse formSection'>";
                // form for inserting new event to db
                echo "<form class='' action='core/forms/admin_form_handler.php' method='post'>
                    <label class='row'>
                        <input class='input' type='hidden' name='event_id' value=''>
                    </label>
                    <label class='row'>
                        <input class='input' type='text' name='name' value='' placeholder='Name of event' required>
                    </label>
                    <label class='row'>
                        <textarea class='input' rows='4' cols='50' type='text' name='description' value='' placeholder='Description' required></textarea>
                    </label>
                    <label class='row'>
                        <input class='input' type='text' name='place' value='' placeholder='Place' required>
                    </label>
                    <label class='row'>
                        <input class='input' type='datetime-local' name='date_time' value='2019-06-12T19:30'>
                    </label>
                    <label class='row'>
                        <input class='input' type='number' name='max_participants' placeholder='Number of participants'>
                    </label>
                    <label class='row'>
                        <input class='input btn btn-info' type='submit' name='submit' value='Add'>
                    </label>
                </form>";
            echo "</div>";
        echo "</div>";

        echo "<div class='col'>";
            echo "<button type='button' class='admin-btn btn btn-info' data-toggle='collapse' data-target='#deleteEvent'>
                Delete Event
            </button>";
            echo "<div id='deleteEvent' class='collapse formSection'>";
                // form for deleting events from db
                echo "<form class='' action='core/forms/admin_form_handler.php' method='post'>";
                    foreach ($eventsRows as $eventRow) {
                        echo "<input type='checkbox' name='eventId[]' value='$eventRow[0]'/> $eventRow[1]";
                        echo "<br>";
                    }
                    echo "<br>";
                    echo "<label class='row'>
                        <input  class='input btn btn-info' type='submit' name='submit' value='Delete'>
                    </label>
                </form>";
            echo "</div>";
        echo "</div>";

        echo "<div class='col'>";

            echo "<button type='button' class='admin-btn btn btn-info' data-toggle='collapse' data-target='#invite'>
                Invite People
            </button>";

            echo "<div id='invite' class='collapse formSection'>";
                // form for inviting people to event
                echo "<form class='' action='core/forms/admin_form_handler.php' method='post'>";

                    echo "<div class='row'>";

                        echo "<div class='col'>";

                            echo "<p>Choose event</p>";
                            foreach ($eventsRows as $eventRow) {
                                echo "<input type='radio' name='event_id' value='$eventRow[0]'/> $eventRow[1]";
                                echo "<br>";
                            }

                        echo "</div>";

                        echo "<div class='col'>";

                            echo "<p>Choose person</p>";
                            // foreach ($allUsers as $user) {
                            //     echo "<input type='checkbox' name='user_id[]' value='$user[0]'/> $user[1] ($user[2])";
                            //     echo "<br>";
                            // }
                            echo "<label class='row'>";
                                echo "<input class='invite-input' type='text' name='personName' placeholder='Name'>";
                            echo "</label>";
                            echo "<label class='row'>";
                                echo "<input class='invite-input' type='text' name='personEmail' placeholder='E-mail'>";
                            echo "</label>";

                        echo "</div>";

                    echo "</div>"; // end of row
                    echo "<br>";

                    echo "<label class='row'>
                        <input  class='invite-btn btn btn-info' type='submit' name='submit' value='Invite'>
                    </label>
                </form>";
            echo "</div>";

        echo "</div>"; // end of col

    echo "</div>"; // end of row

}

?>

<?php

function printSubscribedEvents($subscribedEvents){

    foreach ($subscribedEvents as $subscribedEvent) {
        echo "<p>$subscribedEvent[0]</p>";
    }
}

?>

<?php

function calculateFreePlaces($eventRow, $subscribedUsers){

    if($eventRow[5] == null){
        return UNLIMITED_PLACES;
    }
    else{
        $num_users = (int)count($subscribedUsers);
        $freePlaces = ($eventRow[5] - $num_users);

        return $freePlaces;

    }

}

?>

<?php

function getUserfromURL($users, $user_id){

    return $users->getUserById($user_id);

}

?>
