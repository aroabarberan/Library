<?php

include(dirname(__FILE__) . '/../Cookie.php');

// if (!isExists('users')) {
//     header("location:index.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Content</title>
</head>

<body>
    <h2>Content that you can only see if you are logged in</h2>
    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consequuntur doloribus dolorum earum, ex, labore maiores
        minus natus officia quos reprehenderit sit, tempore. Aspernatur assumenda, atque deleniti doloribus ipsum soluta.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aut dignissimos eum illo incidunt iusto recusandae?
        Assumenda beatae consequuntur distinctio in, neque nihil, odit officia pariatur quidem repellat reprehenderit veniam.
    </div>
    <form action="logOut.php" method="post">
        <input type="submit" value="Log out" id="logOut">
    </form>
</body>

</html>