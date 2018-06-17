<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

$db = new DataBasePDO();
$db->setTable('contacts');
$contacts = $db->readAll();
?>

<body>
    <div>
        <?php foreach ($contacts as $contact): ?>
        <div>
            Id: <?= $contact['id'] ?>
            Name: <?= $contact['name'] ?>
            Last Name: <?= $contact['lastName'] ?>
            Email: <?= $contact['email'] ?>
            Phone: <?= $contact['phone'] ?>
        </div>
        <?php endforeach; ?>
        <p></p>
    </div>
    <button id="addContact">Add contact</button>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <input type="submit" class="saveContact" value="Save" name="save">
        </div>
    </form>
  </div>
</div>

<script>
    var modal = document.getElementById('myModal');
    var addContact = document.getElementById("addContact");
    var closeBtnContact = document.getElementsByClassName("close")[0];
    var saveBtnContact = document.getElementsByClassName("saveContact")[0];

    addContact.onclick = () => modal.style.display = "block";
    closeBtnContact.onclick = () => modal.style.display = "none";
    saveBtnContact.onclick = () => modal.style.display = "none";

    window.onclick = function (event) {
        if (event.target == modal) modal.style.display = "none";

    }
</script>
<?php
if (!isset($_POST['save'])) {
    return;
}
$query = "INSERT INTO contacts (name, lastName, email, phone) VALUES (:name, :lastName, :email, :phone);";

$params = [
    ":name" => $_POST['name'],
    ":lastName" => $_POST['lastName'],
    ":email" => $_POST['email'],
    ":phone" => $_POST['phone'],
];

$db->query($query, $params);


?>

</body>
</html>
