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
    <form method="POST" action="php/register.php">
        <h1>Regisztracio</h1>
        <input type="text" name="felhasznalonev" placeholder="Felhasznalonev">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Jelszo">
        <input type="password" name="pwds" placeholder="Jelszo megerositese">
        <button type="submit" name="sub">Regisztracio</button>
        <a href="login" class="ca">Mar van fiokja? Jelentkezzen be!</a>
    </form>
</main>

</body>
</html>