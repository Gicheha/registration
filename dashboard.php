<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,=1"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>profile page</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway|Roboto;lang=en"/>
    <link rel="stylesheet" href="assets/css/dashboard.css"/>
    <link rel="stylesheet" href="assets/css/cards.css">
</head>
<body>
<!--top bar-->

<!--beginning of drawer items-->
<ul id="navigation">
    <li class="nav-item"><a href="?go=1"> Kitchen Items</a></li>
    <li class="nav-item"><a href="?go=2">Electronics and gadgets</a></li>
    <li class="nav-item"><a href="?go=3">Clothes and gadgets</a></li>
    <li class="nav-item"><a href="?go=4">Others</a></li>
    <li class="nav-item"><a href="sell.php">Sell Items</a></li>
    <li class="nav-item"><a href="?go=5">help</a></li>
    <li class="nav-item"><a href="?go=6">log-out</a></li>
</ul>
<!--the checkbox-->
<input type="checkbox" id="nav-trigger" class="nav-trigger"/>
<label for="nav-trigger" id="toggle-label"></label>

<div id="wrapper">
    <div class="container">
        <?php

    	    session_start();
                if($_SESSION['level'] == 1)
                {
                   # require

                }else
                {
                    #require
                }


        
        ?>
    </div>
</div>

</body>
