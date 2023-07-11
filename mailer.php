<html>
    <head>
        <title>Mailer</title>
    </head>
    <body>
        <form action="send.php" method="post" enctype="multipart/form-data">
            Email <input type="email" name="email"><br>
            Subject <input type="text" name="subject"><br>
            Message <input type="text" name="message"><br>
            <!-- <input type="file" -->
            <button type="submit" name="send">Send</button>
        </form>
    </body>
</html>