<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../index.html");
    exit;
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
$status = ($userdata['Status'] == 0) ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Voting System - Dashboard</title> 
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <style>
        #back, #logout, #votebtn {
            padding: 5px;
            border-radius: 5px;
            background-color: blue;
            color: white;
            margin: 10px;
            cursor: pointer;
        }

        #logout { float: right; }
        #back { float: left; }

        #Profile, #Group {
            background-color: white;
            padding: 20px;
        }

        #Profile {
            float: left;
            width: 30%;
        }

        #Group {
            float: right;
            width: 60%;
        }

        #voted {
            padding: 5px;
            border-radius: 5px;
            color: green;
            font-size: 15px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
    
    <div id="MainSection">
        <div id="HeaderSection">
            <a href="../"><button id="back">Back</button></a>
            <a href="logout.php"><button id="logout">Log Out</button></a>
            <h1>Online Voting System</h1>
        </div>
        <hr>

        <div id="mainpanel">
            <div id="Profile">
                <img src="../uploads/<?php echo $userdata['Photo'] ?>" height="150" width="150"><br><br>
                <b>Name:</b> <?php echo $userdata['Name'] ?><br><br>
                <b>Mobile:</b> <?php echo $userdata['Phone'] ?><br><br>
                <b>Address:</b> <?php echo $userdata['Address'] ?><br><br>
                <b>Status:</b> <?php echo $status ?><br><br>
            </div>

            <div id="Group">
                <?php
                if ($groupsdata) {
                    foreach ($groupsdata as $group) {
                        ?>
                        <div>
                            <img style="float: right" src="../uploads/<?php echo $group['Photo'] ?>" height="100" width="100"> <br><br>
                            <b>Group Name:</b> <?php echo $group['Name'] ?><br>
                            <b>Votes:</b> <?php echo $group['Voters'] ?><br>
                            <?php if ($userdata['Role'] == 1): ?>
                                <form action="../api/votes.php" method="post">
                                    <input type="hidden" name="gvotes" value="<?php echo $group['Voters'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $group['ID'] ?>">
                                    <?php if ($userdata['Status'] == 0): ?>
                                        <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php else: ?>
                                        <button disabled type="button" id="voted">Voted</button>
                                    <?php endif; ?>
                                </form>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                            <hr>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
