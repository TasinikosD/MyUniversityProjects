<!DOCTYPE html>
<html>
    <!-- σύνδεση του html με το css -->
    <link rel="stylesheet" href="εξαμηνου.css">
    <head>
        <!-- για να είναι responsive η σελίδα -->
        <meta name="viewport" content="width=device-width, initialscale=1, minimum-scale=1" />
        <title>Book</title>
    </head>
    <!-- δημιουργία του header ώστε να είναι responsive ανάλογα με τα px της οθόνης -->
    <header class="header">
        <a href="" class="logo">DS Estate</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
        <ul class="menu">
            <li><a href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/feed(login).php">Feed</a></li>
            <li><a href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/create_listing.php">Create Listing</a></li>
            <li><a href="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/login.php">Logout</a></li>
        </ul>
    </header>
    <body>
        <h2 class='c'><?php
            #λήψη του αριθμού από το cookie που αποθηκέυτηκε στο προηγούμενο βήμα
            $k=$_COOKIE['diamerisma'];
                # σύνδεση με τη βάση δεδομένων
                $servername="mysql:host=localhost;dbname=ds_estate";
                $username="root";
                $password="";
                $conn=new PDO($servername,$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    ?>
                    <div class='ΔΙΑΜΕΡΙΣΜΑ1'><?php
                    echo '<br>ΑΡΙΘΜΟΣ ΑΓΓΕΛΙΑΣ: '.$k.'<br><br>';
                    #λήψη όλων των στοιχείων από τις εικόνες με id ίσο με αυτό του διαμερίσματος που επιλέχθηκε από το χρήστη
                    $stmt=$conn->prepare("SELECT * FROM images WHERE id=$k");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $image) {
        ?>
        <!--εμφάνιση φωτογραφιών διαμερίσματος-->
        <img src="<?=$image['image']?>" title="<?=$image['photoname'] ?>" width=20%/>
        <?php
        }
            #λήψη όλων των στοιχείων από τις αγγελίες με id ίσο με αυτό του διαμερίσματος που επιλέχθηκε από το χρήστη
            $stmt=$conn->prepare("SELECT * FROM listings WHERE id=$k");
            $stmt->execute();
            $list=$stmt->fetchAll(PDO::FETCH_ASSOC);
            #εμφάνιση στοιχείων διαμερίσματος
            foreach($list as $row) {
                echo '<br><br><br>Τίτλος: '.$row['Τίτλος'].'<br>';
                echo '<br>Περιοχή: '.$row['Περιοχή'].'<br>';
                echo '<br>Πλήθος δωματίων: '.$row['Πλήθος_δωματίων'].'<br>';
                echo '<br>Τιμή ανά διανυκτέρευση: '.$row['Τιμή_ανά_διανυκτέρευση'].'€<br>';
                echo '<br>Δημοσιεύθηκε από: <br>'.$row['USER'].'<br><br><br>';
            }?>
            </div>
            <div class='ΔΙΑΜΕΡΙΣΜΑ1'>
                <h3>Φόρμα ενοικίασης ακινήτου</h3><br>
                <h3>ΒΗΜΑ 2</h3>
                <!-- εμφάνιση της φόρμας για book -->
                <form action="" method="POST">
                Όνομα: <input type="text" value='<?php echo $_COOKIE['ονομα'] ?>' name='name'><br><br>
                Επώνυμο: <input type="text" value='<?php echo $_COOKIE['επωνυμο'] ?>' name='surname'><br><br>
                Email: <input type="text" value='<?php echo $_COOKIE['mail'] ?>' name='mail'><br>
                <?php
                echo '<br>Ενοικίαση από: '.$_COOKIE['αρχη'].'<br>';
                echo '<br>Ενοικίαση έως: '.$_COOKIE['τελος'].'<br><br><br>';
                $start_date = strtotime($_COOKIE['αρχη']);
                $end_date = strtotime($_COOKIE['τελος']);
                $diafora = ($end_date - $start_date)/60/60/24;
                if($diafora==0){
                    $diafora=1;
                }
                $arxiko = $row['Τιμή_ανά_διανυκτέρευση']*$diafora;
                $timh=$_COOKIE['τιμη'];
                #υπολογισμός τιμής ενοικίασης
                if($timh == ' '){
                    $ekptosh=rand(10,30)/100;
                    $timh1=$arxiko-$arxiko*$ekptosh;
                    $cookie_name='τιμη';
                    $cookie_value=$timh1;
                    setcookie($cookie_name,$cookie_value,time()+86400,'/');
                    header("Refresh:0");
                }
                ?>
            </div>
            <div class='ΔΙΑΜΕΡΙΣΜΑ1'>
            <br><br>
            <?php
            #εμφάνιση τιμής ενοικίασης
                $timh=$_COOKIE['τιμη'];
                 echo 'Τιμή ενοικίασης: '.$timh.'€';
                ?>
                <br><br><input type="submit" name='submit' value="Κράτηση"/><br><br>
                </div></form>
            <?php
            $q=$_COOKIE['αρχη'];
            $t=0;
            $f=0;
            # συνάρτηση για να δούμε εάν ένα string έχει μόνο χαρακτήρες
            function chars($str) {
                return preg_match('/[^a-zA-ZΑ-Ωα-ω]/', $str) > 0;
            }
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                    # λήψη στοιχείων που εισάγει ο χρήστης
                    if(isset($_POST['name'])){
                        $name=$_POST['name'];
                    }
                    if(isset($_POST['surname'])){
                        $surname=$_POST['surname'];
                    }
                    if(isset($_POST['mail'])){
                        $mail=$_POST['mail'];
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης ονόματος
                    if($name==''){
                        echo 'Το Όνομα είναι υποχρεωτικό πεδίο!<br>';
                        $t=1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης επώνυμου
                    if($surname==''){
                        echo 'Το Επώνυμο είναι υποχρεωτικό πεδίο!<br>';
                        $t=1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης email
                    if($mail==''){
                        echo 'Το Email είναι υποχρεωτικό πεδίο!<br>';
                        $t=1;
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο όνομα
                    if(chars($name)==TRUE && $name!=''){
                        echo 'Το όνομα θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο επώνυμο
                    if(chars($surname)==TRUE && $surname!=''){
                        echo 'Το επώνυμο θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης @ στο email
                    if(str_contains($mail, '@')==FALSE && $mail!=''){
                        echo 'Το email θα πρέπει να περιέχει το χαρακτήρα @ για να είναι έγκυρο<br>';
                        $t=1;
                    }
                    #εισαγωγή στοιχείων κράτησης στη βάση δεδομένων
                    if($t==0){
                        $sql='INSERT INTO reservations (ημερομηνια_εναρξης,ημερομηνια_ληξης,ονομα,επιθετο,Email,USER,id,price) VALUES (:start,:end,:name,:surname,:Email,:USER,:id,:price)';
                        $stmt=$conn->prepare($sql);
                        $stmt->bindParam(':start',$_COOKIE['αρχη']);
                        $stmt->bindParam(':end',$_COOKIE['τελος']);
                        $stmt->bindParam(':name',$name);
                        $stmt->bindParam(':surname',$surname);
                        $stmt->bindParam(':Email',$mail);
                        $stmt->bindParam(':USER',$_COOKIE['loginname']);
                        $stmt->bindParam(':id',$k);
                        $stmt->bindParam(':price',$timh);
                        $stmt->execute();
                        #εμφάνιση alert για επιτυχή ενοικίαση και ανακατεύθυνση στο πεδίο feed login
                        echo "<script type='text/javascript'>alert('Επιτυχής ενοικίαση ακινήτου!');
                        window.location='http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/feed(login).php';
                        </script>";
                    }
                }
            ?>
        </h2>
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