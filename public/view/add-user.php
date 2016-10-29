<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action="">
            <label for="fname">First Name:</label><br/>
            <input type="text" name="fname" value="<?php print htmlentities($fname) ?>"/>
            <br/>

            <label for="lname">Last Name:</label><br/>
            <input type="text" name="lname" value="<?php print htmlentities($lname) ?>"/>
            <br/>
            <label for="email">Email:</label><br/>
            <input type="text" name="email" value="<?php print htmlentities($email) ?>" />
            <br/>
            <label for="password">Password:</label><br/>
            <textarea name="password"><?php print htmlentities($password) ?></textarea>
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>

    </body>
</html>
