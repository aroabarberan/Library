<?php

require_once '../functionsCookies.php';

if (isExists('users')) {
    header("location:content.html");
}
?>
<form action="login.php" method="post">
    <div id="login">
        <div>
            <label for="userName">userName </label>
            <input type="text" name="userName" id="userName">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" id="buttonLogin" value="Enviar">
        </div>
    </div>
</form>