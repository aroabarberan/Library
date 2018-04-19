<?php

include(dirname(__FILE__) . '/../Cookie.php');


// if (isExists('users')) {
//     header("location:content.html");
// }
?>
<form action="login.php" method="POST">
    <div id="login">
        <div>
            <label for="userName">userName </label>
            <input type="text" name="userName">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" id="buttonLogin" value="Enviar">
        </div>
    </div>
</form>