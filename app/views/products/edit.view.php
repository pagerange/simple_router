<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <title><?=$title?></title>
    <style>
        
            .btn.btn-danger {
                background: #FF0000;
                color: #FFF;
            }
    
    </style>
</head>
<body>

    <h1><?=$title?></h1>

    <p>Template: edit.view.php</p>

    <form action="/products" method="post">
        <input type="hidden" name="_method" value="PATCH" />
        <p><label for="name">Name:</label><br />
        <input type="text" name="name" required /></p>

        <p><label for="email">Email:</label><br />
        <input type="email" name="email" required /></p>

        <p><input type="submit" value="Submit" /></p>
    </form>

    <form action="/products" method="post">
        <input type="hidden" name="_method" value="DELETE" />
         <input type="hidden" name="id" value="2" />

        <p><input class="btn btn-danger" type="submit" value="Delete" /></p>
    </form>

</body>
</html>