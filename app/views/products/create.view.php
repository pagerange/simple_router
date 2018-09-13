<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <title><?=$title?></title>
</head>
<body>

    <h1><?=$title?></h1>

     <p>Template: <?=basename(__FILE__)?></p>

    <form action="/products" method="post">
        <p><label for="name">Name:</label><br />
        <input type="text" name="name" required /></p>

        <p><label for="email">Email:</label><br />
        <input type="email" name="email" required /></p>

        <p><input type="submit" value="Submit" /></p>
    </form>

</body>
</html>