<!DOCTYPE html>
<html>
    <!-- σύνδεση του html με το css -->
    <link rel="stylesheet" href="εξαμηνου.css">
    <head>
        <!-- για να είναι responsive η σελίδα -->
        <meta name="viewport" content="width=device-width, initialscale=1, minimum-scale=1" />
        <title>Register</title>
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
            <h2>Register</h2><br><br>
            <!-- εμφάνιση της φόρμας για register -->
            <form action="" method="POST">
                <h2>Όνομα: <input type="text" name="Όνομα"></h2>
                <h2>Επώνυμο: <input type="text" name="Επώνυμο"></h2>
                <h2>Username: <input type="text" name="usern"></h2>
                <h2>Password: <input type="password" name="kwdikos" id="password"></h2>
                <input type="checkbox" onclick="myFunction()">Show Password
                <!-- κάλεσμα javascript για εμφάνιση κωδικού και απόκρυψη κωδικού-->
                <script src="εξαμηνου.js"></script>
                <h2>E-mail: <input type="text" name="Email"></h2>
                <input type="submit" value='Register'>
            </form>
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
                if($_SERVER["REQUEST_METHOD"]="POST"){
                    # λήψη στοιχείων που εισάγει ο χρήστης
                    if(isset($_POST['Όνομα'])){
                        $name=$_POST['Όνομα'];
                    }else{
                        $name = " ";
                    }
                    if(isset($_POST['Επώνυμο'])){
                        $surname=$_POST['Επώνυμο'];
                    }else{
                        $surname = " ";
                    }
                    if(isset($_POST['usern'])){
                        $usern=$_POST['usern'];
                    }else{
                        $usern = " ";
                    }
                    $length=4;
                    if(isset($_POST['kwdikos'])){
                        $pass=$_POST['kwdikos'];
                        $length=strlen($pass);
                    }else{
                        $pass = " ";
                    }
                    if(isset($_POST['Email'])){
                        $mail=$_POST['Email'];
                    }else{
                        $mail = " ";
                    }
                    $k=0;
                    $p=0;
                    # λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων
                    $stmt=$conn->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $l=0;
                    $w=0;
                    # έλεγχος εάν υπάρχει ήδη το username και το email που δίνει ο χρήστης
                    if(!empty($result)){
                        foreach($result as $row){
                            if($usern==$row['nameuser']){
                                $l=1;
                            }
                            if($mail==$row['Email']){
                                $w=1;
                            }
                        }
                    }
                    # εμφάνιση μηνύματος για ήδη υπάρχων username
                    if($l==1 && $usern!=' '){
                        echo 'Το username που επιλέξατε χρησιμοποιείται από άλλο χρήστη<br>';
                    }
                    # εμφάνιση μηνύματος για ήδη υπάρχων email
                    if($w==1 && $pass!=' '){
                        echo 'Το email που επιλέξατε χρησιμοποιείται από άλλο χρήστη<br>';
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο όνομα
                    if(chars($name)==TRUE && $name!=' '){
                        echo 'Το όνομα θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο επώνυμο
                    if(chars($surname)==TRUE && $surname!=' '){
                        echo 'Το επώνυμο θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης αριθμού στο κωδικό ή μήκους κωδικού μικρότερου του 4 και μεγαλύτερου του 10
                    if($pass!=''){
                        if((code($pass)==FALSE || ($length<4 || $length>10)==TRUE) && $surname!=' '){
                            echo 'Ο κωδικός θα πρέπει να έχει μήκος από 4 έως 10 γράμματα και έναν τουλάχιστον αριθμό<br>';
                            $k=$k+1;
                        }
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης του χαρακτήρα @ στο email
                    if($mail!=''){
                        if(str_contains($mail, '@')==FALSE && $surname!=' '){
                            echo 'Το email θα πρέπει να περιέχει το χαρακτήρα @ για να είναι έγκυρο<br>';
                            $k=$k+1;
                        }
                    }
                    #εμφάνιση μηνυμάτων για κενές τιμές στα στοιχεία του register
                    if($name==""){
                        echo 'Το Όνομα είναι υποχρεωτικό πεδίο<br>';
                        $p=1;
                    }
                    if($surname==""){
                        echo 'Το Επώνυμο είναι υποχρεωτικό πεδίο<br>';
                        $p=1;
                    }
                    if($usern==""){
                        echo 'Το Username είναι υποχρεωτικό πεδίο<br>';
                        $p=1;
                    }
                    if($pass==""){
                        echo 'Το Password είναι υποχρεωτικό πεδίο<br>';
                        $p=1;
                    }
                    if($mail==""){
                        echo 'Το Email είναι υποχρεωτικό πεδίο<br>';
                        $p=1;
                    }
                    #εισαγωγή στοιχείων νέου χρήστη στη βάση δεδομένων
                    if($k==0 && $p==0 && $w==0 && $l==0 && $name!=" " && $mail!=" " && $surname!=" " && $usern!=" " && $pass!=" "){
                        try{
                            $sql='INSERT INTO users (Όνομα,Επώνυμο,nameuser,kwdikos,Email) VALUES (:name,:surname,:usern,:pass,:mail)';
                            $stmt=$conn->prepare($sql);
                            $stmt->bindParam(':name',$name);
                            $stmt->bindParam(':surname',$surname);
                            $stmt->bindParam(':usern',$usern);
                            $stmt->bindParam(':pass',$pass);
                            $stmt->bindParam(':mail',$mail);
                            $stmt->execute();
                        }catch(PDException $e){
                            echo 'Connection failed: ' .$e->getMessage();
                        }
                        # ανακατέυθυνση πίσω στο πεδίο login 
                        header("Location: http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/login.php");
                        exit();
                    }
                }
            ?>
        </div>    
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