<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['userdata'])) {
    header("location: ../");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = $_SESSION['userdata']['status'] == 0 ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <style>
        #backbtn {
            padding: 5px;
            border-radius: 5px;
            background-color: rgb(68, 255, 0);
            color: white;
            float: left;
            margin: 15px;
        }
        #logoutbtn {
            padding: 5px;
            border-radius: 5px;
            background-color: rgb(68, 255, 0);
            color: white;
            float: right;
        }
        #Profile {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }
        #Group {
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
        }
        #votebtn {
            padding: 5px;
            font-size: 15px;
            background-color: #3439db;
            color: white;
            border-radius: 5px;
        }
        #mainPanel {
            padding: 10px;
        }
        #voted {
            padding: 5px;
            font-size: 15px;
            background-color: green;
            color: white;
            border-radius: 5px;
        }
    </style>

    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>

        <div id="mainpanel"> 
            <div id="Profile">
                <center><img src="../uploads/<?php echo $userdata['photo']; ?>" height="150" width="150"></center><br><br>
                <b>Name:</b> <?php echo $userdata['name']; ?><br><br>
                <b>Mobile:</b> <?php echo $userdata['mobile']; ?><br><br>
                <b>Address:</b> <?php echo $userdata['address']; ?><br><br>
                <b>Status:</b> <?php echo $status; ?><br><br>
            </div>

            <div id="Group">
                <?php if ($groupsdata) {
                    foreach ($groupsdata as $group) { ?>
                        <div>
                            <img src="../uploads/<?php echo $group['photo']; ?>" height="100" width="100"><br><br>
                            <b>Group Name:</b> <?php echo $group['name']; ?><br><br>
                            <b>Votes:</b> <?php echo $group['votes']; ?><br><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                                <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                                <?php if ($_SESSION['userdata']['status'] == 0) { ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                <?php } else { ?>
                                    <button disabled type="button" name="votebtn">Voted</button>
                                <?php } ?>
                            </form>
                        </div>
                        <hr>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</body>
</html>
