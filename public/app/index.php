<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div>
        <h1>Inloggad som <span id="username"></span></h1>
        <h2>Konto: <span id="account"></span></h2>
        <h2>Valuta: <span id="currency"></span></h2>
        <h2>Balans: <span id="balance"></span></h2>
    </div>
    <div id="changeUser">
        <form id="changeUserForm" action="/">
            <select name="changeUserSelect" id="changeUserDrop">
            </select>
            <button type="submit">Change User</button>
        </form>
    </div>

    <div id="bankTransfer">
        <h1>Bank transfer</h1>
        <form id="bankTransferForm" action="/">
            <select name="bankTransferSelect" id="usersDrop">

            </select>
            <input id="transferAmount" type="text">
            <button type="submit">Transfer</button>
        </form>
    </div>

    <div id="swish">

    </div>

    <?php

    /*
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();
*/

    //$userInfo = file_get_contents('../api/getUserInfo.php');
    //var_dump($userInfo);
    /*
foreach ($userInfo as $value) {
    print_r($value);
}*/
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
</body>

</html>