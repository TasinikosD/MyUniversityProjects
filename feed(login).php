<!DOCTYPE html>
<html>
    <!-- σύνδεση του html με το css -->
    <link rel="stylesheet" href="εξαμηνου.css">
    <head>
        <!-- για να είναι responsive η σελίδα -->
        <meta name="viewport" content="width=device-width, initialscale=1, minimum-scale=1" />
        <title>Feed</title>
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
         <h2><?php
                # σύνδεση με τη βάση δεδομένων
                $servername="mysql:host=localhost;dbname=ds_estate";
                $username="root";
                $password="";
                $conn=new PDO($servername,$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                # λήψη όλων των id από τις εικόνες με σκοπό την έυρεση του αριθμού των αγγελιών
                $stmt=$conn->prepare("SELECT id FROM images");
                $stmt->execute();
                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                $t=0;
                # έυρεση αριθμού αγγελιών
                foreach($result as $image){
                    $t=$image['id'];
                }
                # εμφάνιση αγγελιών 
                for($i=1; $i<=$t; $i++){
                    ?>
                    <div class='ΔΙΑΜΕΡΙΣΜΑ1'><?php
                    echo '<br>ΑΡΙΘΜΟΣ ΑΓΓΕΛΙΑΣ: '.$i.'<br><br>';
                    $stmt=$conn->prepare("SELECT * FROM images WHERE id=$i");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $image) { ?>
                <!-- εμφάνιση όλων των εικόνων της κάθε αγγελίας-->
                    <img src="<?=$image['image']?>" title="<?=$image['photoname'] ?>" width=20%/> <?php
        }
            # λήψη όλων των στοιχείων από τη βάση δεδομένων όπου id είναι ίσο με το κάθε i
            $stmt=$conn->prepare("SELECT * FROM listings WHERE id=$i");
            $stmt->execute();
            $list=$stmt->fetchAll(PDO::FETCH_ASSOC);
            #εμφάνιση των στοιχείων κάθε αγγελίας
            foreach($list as $row) {
                echo '<br><br><br>Τίτλος: '.$row['Τίτλος'].'<br>';
                echo '<br>Περιοχή: '.$row['Περιοχή'].'<br>';
                echo '<br>Πλήθος δωματίων: '.$row['Πλήθος_δωματίων'].'<br>';
                echo '<br>Τιμή ανά διανυκτέρευση: '.$row['Τιμή_ανά_διανυκτέρευση'].'€<br>';
                echo '<br>Δημοσιεύθηκε από: <br>'.$row['USER'].'<br><br><br>';
            }
            ?>
            <!-- ανακατεύθυνση στο πεδίο book-->
            <form action="http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/Book.php" method="POST">
                Πατείστε το κουμπί για να κάνετε κράτηση: 
                <br><br>Book: <input type="submit" name='numbers' value=<?php echo $i; ?>><br><br>
            </form>
            </div>
            <?php
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