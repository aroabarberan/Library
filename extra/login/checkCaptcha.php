<?php
if (isset($_POST['sendCaptcha'])) {
    if ($_POST['letters'] == $_POST['resultCaptcha']) {
        echo "Coincide";
    } else {
        echo "No coincide";
    }
}
