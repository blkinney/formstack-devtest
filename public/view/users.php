<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Users</title>
        <style type="text/css">
            table.users {
                width: 100%;
            }

            table.users thead {
                background-color: #eee;
                text-align: left;
            }

            table.users thead th {
                border: solid 1px #fff;
                padding: 3px;
            }

            table.users tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }

            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div><a href="index.php?op=new">Add new user</a></div>
        <table class="users" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><a href="index.php?op=update&id=<?php print $user->id; ?>"><?php print htmlentities($user->fname); ?></a></td>
                    <td><?php print htmlentities($user->lname); ?></td>
                    <td><?php print htmlentities($user->email); ?></td>
                    <td><?php print htmlentities($user->password); ?></td>
                    <td><a href="index.php?op=delete&id=<?php print $user->id; ?>">delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
