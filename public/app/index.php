<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div>
            <h2>Inloggad som <span id="username"></span></h2>
            <h5>Konto: <span id="account"></span></h5>
            <h5>Mobil: <span id="phone"></span></h5>
            <h5>Valuta: <span id="currency"></span></h5>
            <h5>Balans: <span id="balance"></span></h5>
        </div>
        <div id="changeUser">
            <h2>Byt användare</h2>
            <form id="changeUserForm" action="/">
                <select name="changeUserSelect" id="changeUserDrop">
                </select>
                <button class="btn btn-dark" type="submit">Byt användare</button>
            </form>
        </div>

        <div id="bankTransfer">
            <h2>Banköverföring</h2>
            <form id="bankTransferForm" action="/">
                <label for="bankTransferSelect">Mottagare:</label>
                <select name="bankTransferSelect" id="usersDrop">

                </select>
                <label for="transferAmount">Belopp:</label>
                <input id="transferAmount" type="text">
                <button class="btn btn-dark" type="submit">Överför</button>
            </form>
        </div>

        <div id="swish">
            <h2>Swish</h2>
            <form id="swishForm" action="/">
                <label for="swishSelect">Mottagare:</label>
                <select name="swishSelect" id="swishDrop">

                </select>
                <label for="swishAmount">Belopp:</label>
                <input id="swishAmount" type="text">
                <button class="btn btn-dark" type="submit">Swish</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
</body>

</html>