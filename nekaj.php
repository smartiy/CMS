<!DOCTYPE html>

<?php

if(isset($_POST['submit'])) {
    
    $email = $_POST['email'];
    $to = "samo.goljat1@gmail.com";
//    $to = "samo.smartiy@gmail.com";
    $subject = $_POST['country'];
    $text = "to je tekst";
    $text = $_POST['subject'];
    $headers = "From: {$email}";
        
    mail($to,$subject,$text);
    
}
?>

<?php

if(isset($_POST['submit'])) {
    $to = "samo.smartiy@gmail.com";
    $subject = "My subject";
    $txt = "Hello world!";
    $headers = "From: webmaster@example.com" . "\r\n" .
    "CC: somebodyelse@example.com";

    mail($to,$subject,$txt);

}

?>




<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <title> DigitalSGMarketing </title>
        <link rel="icon" href="logotip/S-digital10.png">
        <link rel="stylesheet" href="style.css"> 
    </head>
    <body>
        <header>
        </header>
        <nav>
            <div class="logo">
                <a href="domov"><img src="logotip/S-digital10.png"  height=140  align=left></a>
            </div>  
                <ul class="nav-links">
                    <li><a href="spletne_strani"> Spletne strani</a></li>
                    <li><a href="optimizacija"> Optimizacija </a></li>
                    <li><a href="cenik"> Cenik </a></li>
                    <li><a href="kontakt"> Kontakt </a></li>
                    <!--<li><a href="blog"> Blog </a></li>-->
                </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
        <div class="povprasevanje">
            <div class="povprasevanje1">
                <h2>Povpraševanje</h2>
                <br>
                <form method="post" action="form_process.php">
                    <label for="fname">Ime</label>
                    <input type="text" id="fname" name="firstname" placeholder="Vaše ime..">

                    <label for="lname">Priimek</label>
                    <input type="text" id="lname" name="lastname" placeholder="Vaš priimek..">
                    
                    <label for="lname">Podjetje</label>
                    <input type="text" id="company" name="company" placeholder="Vaše podjetje..">
                    
                    <label for="lname">Email</label>
                    <input type="text" id="email" name="email" placeholder="Vaš email...">

                    <label for="country">Željena storitev</label>
                    <select id="country" name="country">
                        <option value="australia">Wordpress spletna stran</option>
                        <option value="canada">Statična spletna stran</option>
                    </select>

                    <label for="subject">Podrobnosti</label>
                    <textarea id="subject" name="subject" placeholder="Sporočilo.." style="height:200px"></textarea>
                    
                    <input type="submit" name="submit" value="Oddaj">
                </form>
            </div>
        </div>

    <footer>
        <span style="color:Black">Copyright -</span> DigitalSGmarketing
    </footer>  
    <script type="text/javascript" src="javascript.js"></script>          
    </body>
</html>