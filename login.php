<!DOCTYPE html>
<html>
    <!-- σύνδεση του html με το css -->
    <link rel="stylesheet" href="εξαμηνου.css">
    <head>
        <!-- για να είναι responsive η σελίδα -->
        <meta name="viewport" content="width=device-width, initialscale=1, minimum-scale=1" />
        <title>Login</title>
    </head>
    <!-- δημιουργία του header ώστε να είναι responsive ανάλογα με τα px της οθόνης -->
    <header class="header">
        <a href="" class="logo">DS Estate</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
        <ul class="menu">
            <li><a href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/feed.php">Feed</a></li>
            <li><a href="">Create Listing</a></li>
            <li><a href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/login.php">Login</a></li>
        </ul>
    </header>
    <body>
        <div class='ΔΙΑΜΕΡΙΣΜΑ1'>
            <h2>Login</h2><br><br>
            <!-- εμφάνιση της φόρμας για login -->
            <form action="" method="POST">
                <h3>Username: <input type="text" name="nameuser"></h3>
                <h3>Password: <input type="password" name="code" id="password"></h3>
                <input type="checkbox" onclick="myFunction()">Show Password
                <!-- κάλεσμα javascript για εμφάνιση κωδικού και απόκρυψη κωδικού-->
                <script src="εξαμηνου.js"></script>
                <br><br><input type="submit" value="Login">
            </form>
            <!-- εμφάνιση μηνύματος για register εάν δεν υπάρχει λογαριασμός-->
            <h2>Εάν δεν έχετε λογαριασμό κάντε <a class="register" href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/register.php">Register</a></h2><br><br>  
        <?php
                # σύνδεση με τη βάση δεδομένων
                $servername="mysql:host=localhost;dbname=ds_estate";
                $username="root";
                $password="";
                $conn=new PDO($servername,$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                # συνάρτηση για να δούμε εάν ένα string έχει μόνο χαρακτήρες
                function chars($str) {
                    return preg_match('/[^a-zA-ZΑ-Ωα-ω]/', $str) > 0;
                }
                # συνάρτηση για να δούμε εάν ένα string έχει έστω έναν αριθμό
                function code($str) {
                    return preg_match('~[0-9]+~', $str) > 0;
                }
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    # λήψη username και password που εισάγει ο χρήστης
                    if(isset($_POST['nameuser'])){
                        $user=$_POST['nameuser'];
                    }else{
                        $user = "";
                    }
                    $length=4;
                    if(isset($_POST['code'])){
                        $pass=$_POST['code'];
                        $length=strlen($pass);
                    }else{
                        $pass = "";
                    }
                    # λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων
                    $stmt=$conn->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $t=0;
                    $a=0;
                    if(!empty($result)){
                        foreach($result as $row){
                            # έλεγψος των username και password της βάσης δεδομένων με αυτά που έχει δώσει ο χρήστης και login εάν ταιριάζουν
                            if($user==$row['nameuser'] && $pass==$row['kwdikos']){
                                # αποθήκευση στοιχείων χρήστη σε cookies με διάρκεια μία μέρα
                                $cookie_name='loginname';
                                $cookie_value=$user;
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                $cookie_name='ονομα';
                                $cookie_value=$row['Όνομα'];
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                $cookie_name='επωνυμο';
                                $cookie_value=$row['Επώνυμο'];
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                $cookie_name='mail';
                                $cookie_value=$row['Email'];
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                # ανακατέυθυνση στη σελίδα feed για login χρήστες
                                header("Location: http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/feed(login).php");
                                exit();
                            }
                            if($user==$row['nameuser']){
                                $t=$t+1;
                            }
                            if($user==$row['nameuser'] && $pass!=$row['kwdikos']){
                                $a=$a+1;
                            }
                        }
                    }
                    # μηνύματα λάθους για λάθος στοιχεία σύνδεσης
                    if($t==0){
                        echo 'Δεν υπάρχει χρήστης με αυτό το username<br>';
                    }
                    if($a==1){
                        echo 'Λάθος κωδικός πρόσβασης<br>';
                    }
                }
            ?></div>  
    </body>
    <!-- footer με στοιχεία της εταιρίας ενοικιάσεων-->
    <footer>
        <div class='f'>
            <div class='f1'>
                <h3>Στοιχεία επικοινωνίας:</h3>
                <h3>Τηλέφωνο: <a class='thlefono' href="tel:2104142076">210-4142076</a></h3>
                <h3>Email: <a class='email' href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJZZzJFljFXRkLlrbXgrrvsCnWgSkQJckptZLMMSXJTZkKjkLfqrxtpXDZgscWVdXFXmDqV">gramds@unipi.gr</a></h3>
            </div>
            <div class='f1'>
                <h3>Θα μας βρείτε εδώ:</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3146.5217695220817!2d23.6529793!3d37.941601299999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bbe5bb8515a1%3A0x3e0dce8e58812705!2zzqDOsc69zrXPgM65z4PPhM6uzrzOuc6_IM6gzrXOuc-BzrHOuc-Oz4I!5e0!3m2!1sel!2sgr!4v1717243303031!5m2!1sel!2sgr" width="250" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </footer>
</html>