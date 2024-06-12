<?php
require_once "pdo.php";
require_once "util.php";
session_start();

if ( !isset($_SESSION['user_id'])) {
    die('ACCESS DENIED');
    return;
} 

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

if ( isset($_POST['first_name']) && isset($_POST['last_name'])
     && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])  ) {

    $msg = validateProfile();
    if( is_string($msg) ){
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    $msg = validatePos();
    if( is_string($msg) ){
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    $msg = validateEdu();
    if( is_string($msg) ){
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }
    
    $stmt = $pdo->prepare("INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
              VALUES (:uid, :first_name, :last_name, :email, :headline, :summary)");
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':headline' => $_POST['headline'],
        ':summary' => $_POST['summary'],));

        $profile_id = $pdo->lastInsertId();  //https://www.php.net/manual/en/pdo.lastinsertid.php

        

        // Insert the position entries
        insertPositions($pdo, $profile_id);

        // Insert the education entries
        insertEducations($pdo, $profile_id);

    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}
    


?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once "head.php"; ?>
        <title>John A 00063ece's Profile Add</title>
    </head>
    <body>
        <div class="container">
            <h1>Adding Profile for<?= htmlentities($_SESSION['name']); ?></h1>
        <?php flashMessages(); ?>
<p>Add A New Auto</p>
<form method="post">
<p>First Name:
<input type="text" name="first_name"></p>
<p>Last Name:
<input type="text" name="last_name"></p>
<p>Email:
<input type="text" name="email"></p>
<p>Headline:
<input type="text" name="headline"></p>
<p>Summary:
<textarea type="text" name="summary"></textarea></p>
<p>Education:
<input type="submit" id="addEdu" value="+">
<div id="education_fields">
</div>
</p>
<p>Positions:
<input type="submit" id="addPos" value="+">
<div id="position_fields">
</div>
</p>
<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
</div>

<script>
    countPos = 0;
    //https://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript

    $(document).ready(function(){
        window.console && console.log('Document ready called');
        $('#addPos').click(function(event){
            event.preventDefault();
            if( countPos >= 9){
                alert("Maximum of nine position entries exceeded");
                return;
            }
            countPos++;
            window.console && console.log('Adding position'+countPos);
            $('#position_fields').append(
                '<div id="position'+countPos+'"> \
                <p>Year: <input type="text" name="year'+countPos+'" value="" /> \
                <input type="button" value="-"   \
                        onclick="$(\'#position'+countPos+'\').remove();return false;" />    \
                </p>  \
                <textarea name="desc'+countPos+'" rows="8" clos="80"></textarea>  \
                </div>'
            );
        });
        countEdu = 0
        $('#addEdu').click(function(event){
            event.preventDefault();
            if( countEdu >= 9){
                alert("Maximum of nine education entries exceeded");
                return;
            }
            countEdu++;
            window.console && console.log('Adding education'+countEdu);
            $('#education_fields').append(
                '<div id="education'+countEdu+'"> \
                <p>Year: <input type="text" name="edu_year'+countEdu+'" value="" /> \
                <input type="button" value="-"   \
                        onclick="$(\'#education'+countEdu+'\').remove();return false;" />    \
                </p>  \
                <p>School: <input type="text" size="80" name="edu_school'+countEdu+'" class="school" value="" rows="8" clos="80" /></p>  \
                </div>'
            ); $('.school').autocomplete({source: "school.php"});
        });
       
    })
</script>
</body>
</html>
