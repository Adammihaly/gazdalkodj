<!DOCTYPE html>
<html>
<head>
    <title>Gazdalkodj</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css ">
    <script src="./js/main.js"></script>
</head>
<body>
    
<main>
    <form method="POST" action="php/login.php">
        <h1>Bejelentkezes</h1>
        <input type="text" name="username" placeholder="Felhasznalonev vagy email cim">
        <input type="password" name="pwd" placeholder="Jelszo">
        <button type="submit" name="sub">Bejelentkezes</button>
        <a href="register" class="ca">Nincs meg fiokod? Regisztralj!</a>
    </form>
</main>

</body>
</html>