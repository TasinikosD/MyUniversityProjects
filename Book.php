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
        #λήψη του αριθμού από το feed login για εμφάνιση των στοιχείων του ακινήτου που επέλεξε
        $i = filter_input(INPUT_POST, 'numbers', FILTER_SANITIZE_STRING);
        #έλεγχος για ύπαρξη του διαμερίσματος για να εισαχθεί η τιμή σε μεταβλητή
        if(isset($i)){
            $cookie_name='diamerisma';
            $cookie_value=$i;
            setcookie($cookie_name,$cookie_value,time()+86400,'/');
            $k=$i;
        }
        else{
            $k=$_COOKIE['diamerisma'];
        }
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
            }
            ?>
            </div>
            <div class='ΔΙΑΜΕΡΙΣΜΑ1'>
                <h3>Φόρμα ενοικίασης ακινήτου</h3><br>
                <h3>ΒΗΜΑ 1</h3>
                <!-- εμφάνιση της φόρμας για book -->
                <form action="" method="POST">
                    <h3>Ημερομηνία έναρξης ενοικίασης:<br>
                    <input type=date name='εναρξη'></h3>
                    <h3>Ημερομηνία λήξης ενοικίασης:<br>
                    <input type=date name='ληξη'></h3>
                    <input type=submit name='submit' value='Συνέχεια'>
                </form>
                <br>
            </div>
            <?php
            # σύνδεση με τη βάση δεδομένων
            $servername="mysql:host=localhost;dbname=ds_estate";
            $username="root";
            $password="";
            $conn=new PDO($servername,$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # λήψη των ημερών ενοικίασης του διαμερίσματος από το χρήστη από τη βάση δεδομένων όπου id ίσο με το id του διαμερίσματος
            $stmt=$conn->prepare("SELECT ημερομηνια_εναρξης,ημερομηνια_ληξης FROM reservations WHERE id=$k");
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $t=0;
            $p=0;
            $r=0;
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    #λήψη των ημερομηνιών που δίνει ο χρήστης
                    if(isset($_POST['εναρξη'])){
                        $εναρξη=$_POST['εναρξη'];
                    }
                    else{
                        $εναρξη=' ';
                    }
                    if(isset($_POST['ληξη'])){
                        $ληξη=$_POST['ληξη'];
                    }
                    else{
                        $ληξη=' ';
                    }
                    $start1=$εναρξη;
                    $end1=$ληξη;
                    $today=date('Y-m-d');
                    #εμφάνιση μηνύματος για μη συμπλήρωση ημερομηνιών
                    if($start1=='' || $end1==''){
                        echo 'Η ημερομηνία είναι υποχρεωτικό πεδίο!<br>';
                        $t=1;
                    }
                    #εμφάνιση μηνύματος για ημερομηνία έναρξης μεγαλύτερη από την ημερομηνία λήξης
                    if($start1>$end1){
                        echo 'Η ημερομηνία έναρξης της ενοικίασης πρέπει να είναι μικρότερη της ημερομηνίας λήξης!<br>';
                        $p=1;
                    }
                    #εμφάνιση μηνύματος για ημερομηνίες που έχουν παρέλθει
                    if(($start1<$today || $end1<$today) && $start1!='' && $end1!='' && $start1!=' ' && $end1!=' '){
                        echo 'Η ημερομηνία έναρξης και λήξης της ενοικίασης πρέπει να είναι ημερομηνία η οποία δεν έχει παρέλθει!<br>';
                        $r=1;
                    }
                if($t==0 && $εναρξη!='' && $ληξη!='' && $p==0 && $start1<=$end1 && $εναρξη!=' ' && $ληξη!=' ' && $r==0){
                    if(!empty($result)){
                        foreach($result as $row){
                            $start2=($row['ημερομηνια_εναρξης']);
                            $end2=($row['ημερομηνια_ληξης']);
                            #δημιουργία cookies σε περίπτωση ελεύθερων ημερομηνιών
                            if(($start2<$start1 && $end2<$start1) || ($start2>$end1 && $end2>$end1)){
                                $cookie_name='αρχη';
                                $cookie_value=$εναρξη;
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                $cookie_name='τελος';
                                $cookie_value=$ληξη;
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                                $cookie_name='τιμη';
                                $cookie_value=' ';
                                setcookie($cookie_name,$cookie_value,time()+86400,'/');
                            }
                            else{
                                #εμφάνιση alert σε περίπτωση μη ελεύθερων ημερομηνιών
                                echo '<script>alert("Το δωμάτιο δεν είναι διαθέσιμο στις ημερομηνίες που επιλέξατε!")</script>'; 
                                $r=1;
                            }
                        }
                    }
                    #δημιουργία cookies σε περίπτωση ελεύθερων ημερομηνιών
                    else{
                        $cookie_name='αρχη';
                        $cookie_value=$εναρξη;
                        setcookie($cookie_name,$cookie_value,time()+86400,'/');
                        $cookie_name='τελος';
                        $cookie_value=$ληξη;
                        setcookie($cookie_name,$cookie_value,time()+86400,'/');
                        $cookie_name='τιμη';
                        $cookie_value=' ';
                        setcookie($cookie_name,$cookie_value,time()+86400,'/');
                        $cookie_name='τιμη1';
                        $cookie_value=' ';
                        setcookie($cookie_name,$cookie_value,time()+86400,'/');
                    }
                    #ανακατεύθυνση στο πεδίο book βήμα 2 σε περίπτωση ελεύθερων ημερομηνιών
                    if($r==0){
                        header("Location: http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/BookNo2.php");
                    }
                }}
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