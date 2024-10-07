<!DOCTYPE html>
<html>
    <!-- σύνδεση του html με το css -->
    <link rel="stylesheet" href="εξαμηνου.css">
    <head>
        <!-- για να είναι responsive η σελίδα -->
        <meta name="viewport" content="width=device-width, initialscale=1, minimum-scale=1" />
        <title>Create Listing</title>
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
        <div class='ΔΙΑΜΕΡΙΣΜΑ1'>
            <!-- εμφάνιση της φόρμας για create listing -->
            <form action='' method='POST' enctype='multipart/form-data'>
                <h2>Δημιουργείστε τη δική σας αγγελία</h2><br><br>
                <h2>Τίτλος: <input type="text" name="τίτλος"></h2>
                <h2>Περιοχή: <input type="text" name="περιοχή"></h2>
                <h2>Πλήθος δωματίων: <input type="text" name="δωμάτια"></h2>
                <h2>Τιμή ανά διανυκτέρευση: <input type="text" name="τιμή"> €</h2>
                <h2>Επιλέξτε τις φωτογραφίες της αγγελίας σας:</h2>
                <input type="file" name="files[]" multiple/>
                <br><br><input type="submit" name='submit' value="Αποθήκευση αγγελίας"/>
            </form>   
        <?php
            # σύνδεση με τη βάση δεδομένων
            $servername="mysql:host=localhost;dbname=ds_estate";
            $username="root";
            $password="";
            $conn=new PDO($servername,$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($_SERVER["REQUEST_METHOD"]="POST"){
                if(isset($_POST['submit'])) {
                    $k=0;
                    # συνάρτηση για να δούμε εάν ένα string έχει έστω έναν αριθμό
                    function code1($str) {
                        return preg_match('~[0-9]+~', $str) > 0;
                    }
                    # συνάρτηση για να δούμε εάν ένα string έχει μόνο χαρακτήρες
                    function code2($str) {
                        return preg_match('/[A-Za-zΑ-Ωα-ω]/', $str) > 0;
                    }
                    # συνάρτηση για να δούμε εάν ένα string έχει μόνο σύμβολα
                    function code3($str) {
                        return preg_match_all('/[!@#$%^&*(),.?":{}|<>]/', $str) > 0;
                    }
                    # λήψη στοιχείων που εισάγει ο χρήστης
                    if(isset($_POST['τίτλος'])){
                        $title=$_POST['τίτλος'];
                    }else{
                        $title = "";
                    }
                    if(isset($_POST['περιοχή'])){
                        $region=$_POST['περιοχή'];
                    }else{
                        $region = "";
                    }
                    if(isset($_POST['δωμάτια'])){
                        $rooms=$_POST['δωμάτια'];
                    }else{
                        $rooms = "";
                    }
                    if(isset($_POST['τιμή'])){
                        $price=$_POST['τιμή'];
                    }else{
                        $price = "";
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο τίτλο
                    if(code1($title)==TRUE){
                        echo 'Ο τίτλος θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης τίτλου
                    if($title==''){
                        echo 'Ο τίτλος είναι υποχρεωτικό πεδίο<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στη περιοχή
                    if(code1($region)==TRUE){
                        echo 'Η περιοχή θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης περιοχής
                    if($region==''){
                        echo 'Η περιοχή είναι υποχρεωτικό πεδίο<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης ακέραιου αριθμού δωματίων
                    if((code3($rooms)==TRUE || code2($rooms)==TRUE) && $rooms!=''){
                        echo 'Το πλήθος των δωματίων θα πρέπει να είναι ακέραιος αριθμός<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης αριθμού δωματίων
                    if($rooms==''){
                        echo 'Ο αριθμός των δωματίων είναι υποχρεωτικό πεδίο<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης ακέραιου αριθμού τιμής ενοικίασης
                    if((code3($price)==TRUE || code2($price)==TRUE) && $price!=''){
                        echo 'Η τιμή ενοικίασης θα πρέπει να είναι ακέραιος αριθμός<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη συμπλήρωσης τιμής ενοικίασης
                    if($price==''){
                        echo 'Η τιμή ενοικίασης είναι υποχρεωτικό πεδίο<br>';
                        $k=$k+1;
                    }
                    # λήψη όλων των id των κρατήσεων από τη βάση δεδομένων
                    $stmt=$conn->prepare('SELECT id FROM listings');
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $t=0;
                    # έυρεση αριθμού αγγελιών
                    foreach($result as $row){
                        $t=$row['id'];
                    }
                    if($t!=''){
                        $t=$t+1;
                    }
                    else{
                        $t==1;
                    }
                    $id=$t;
                    #μέτρηση αριθμού φωτογραφιών που έδωσε ο χρήστης
                    $countfiles = count($_FILES['files']['name']);
                    #εμφάνιση μηνύματος για μη ανέβασμα φωτογραφιών
                    if($countfiles-1==0){
                        echo 'Το ανέβασμα έστω μίας φωτογραφίας του ακινήτου είναι υποχρεωτικό';
                    }
                    #εισαγωγή στοιχείων στη βάση δεδομένων
                    if($countfiles-1>0 && $k==0){
                        $query = "INSERT INTO images (photoname,image) VALUES(?,?)";
                        $statement = $conn->prepare($query);
                        for($i = 0; $i < $countfiles; $i++) {
                            $filename = $_FILES['files']['name'][$i];
                            $target_file = 'images/'.$filename;
                            $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                            $file_extension = strtolower($file_extension);
                            $valid_extension = array("png","jpeg","jpg");
                            if(in_array($file_extension, $valid_extension)) {
                                if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
                                    $statement->execute(array($filename,$target_file));
                                    $sql='UPDATE images SET id=? WHERE id=0';
                                    $stmt=$conn->prepare($sql);
                                    $stmt->execute([$id]);
                                }
                            }
                        }
                        $sql='INSERT INTO listings (Τίτλος,Περιοχή,Πλήθος_δωματίων,Τιμή_ανά_διανυκτέρευση,id,USER) VALUES (:title,:region,:rooms,:price,:id,:xrhsths)';
                        $stmt=$conn->prepare($sql);
                        $stmt->bindParam(':title',$title);
                        $stmt->bindParam(':region',$region);
                        $stmt->bindParam(':rooms',$rooms);
                        $stmt->bindParam(':price',$price);
                        $stmt->bindParam(':id',$id);
                        $stmt->bindParam(':xrhsths',$_COOKIE['loginname']);
                        $stmt->execute();
                        # ανακατέυθυνση στη σελίδα feed για login χρήστες
                        header("Location: http://localhost/ΕΡΓΑΣΙΑ_ΕΞΑΜΗΝΟΥ/feed(login).php");
                        exit();
                    }
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