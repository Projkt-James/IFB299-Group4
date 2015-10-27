<?php
    //Webpage Includes List
    include '../includes/head.php';
    include '../includes/connect.php';

    if (!isset($_SESSION['login'])) { 
        header('location:login.php'); 
    }

    //Webpage Title
    $Title = $_SESSION['username'] . " - User Settings";

    displayHead($Title);
    displayNav();
    displayTopBar();

    $memberID = $_SESSION['login'];
    $sql = "SELECT * FROM member WHERE memberID = '$memberID'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)); 
    $row = mysqli_fetch_array($result);
?>

        <div class="Settings-Container"> 
            
            <div class="Settings-Head">
                <h1>Settings</h1>
            </div>
            
            <!------------------------------------
            - UPDATE ACCOUNT DETAILS
            -------------------------------------->                
            <div class="Settings-Account">
                <h1>Account Details</h1>
                    
                <form class="Update-Form Update_Form" name="Account-Update" action="settings-process.php" method="post">
                    <ul>
                        <!-- First Name -->
                        <li>
                            <span class="Input_Icon fa fa-user"></span>
                            <input id="update_firstname" type="text" value="<?php if(!empty($row['memberFirstName']))echo $row['memberFirstName'];?>" name="update_firstname" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" autocomplete="off" />
                            <?php 
                                if (isset($_SESSION['errorFirstName'])){
                                    echo '<p class="InputError">Try Again: ' . $_SESSION['errorFirstName'] . "</p>";
                                    unset($_SESSION['errorFirstName']); 
                                } 
                                ?>        
                        </li>            
                            
                            
                            <!-- Last Name -->
                            <li>
                                <span class="Input_Icon fa fa-user"></span>
                                <input id="update_lastname" type="text" value="<?php if(!empty($row['memberLastName']))echo $row['memberLastName'];?>" name="update_lastname" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" autocomplete="off"/>
                                <?php 
                                    if (isset($_SESSION['errorLastName'])){
                                        echo '<p class="InputError">Try Again: ' . $_SESSION['errorLastName'] . "</p>";
                                        unset($_SESSION['errorLastName']); 
                                    } 
                                ?>
                            </li>
                            
                            <!-- Gender -->
                            <li>
                                <span class="Input_Icon fa fa-heart"></span>
                                <span class="Input_Hide"></span>
                                <select id="update_gender" name="update_gender">
                                    <option value="1" disabled>Gender</option>
                                    <option value="M" <?php if($row['memberGender'] == "M")echo 'selected'; ?> >Male</option>
                                    <option value="F" <?php if($row['memberGender'] == "F")echo 'selected'; ?> >Female</option>
                                </select>
                                <?php 
                                    if (isset($_SESSION['errorGender'])){
                                        echo '<p class="InputError">Try Again: ' . $_SESSION['errorGender'] . "</p>";
                                        unset($_SESSION['errorGender']); 
                                    } 
                                ?>
                            </li>
                            
                            <!-- Country -->
                            <li>
                                <span class="Input_Icon fa fa-globe"></span>
                                <select id="update_country" name="update_country">
                                    <div>
                                    <option value="default" disabled selected>Select A Country</option>       
                                    <?php
                                        $sql2 = "SELECT * FROM country";
                                        $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con)); 

                                        while ($row2 = mysqli_fetch_array($result2)){
                                            echo '<option value="'. $row2['countryID'] .'"';
                                            if($row['countryID'] == $row2['countryID'])echo 'selected'; 
                                            echo '>'. $row2['country'] .'</option>';   
                                        }
                                    ?>
                                    </div>
                                </select>
                                <?php 
                                    if (isset($_SESSION['errorCountry'])){
                                        echo '<p class="InputError">Try Again: ' . $_SESSION['errorCountry'] . "</p>";
                                        unset($_SESSION['errorCountry']); 
                                    } 
                                ?>
                            </li>
                            
                            <!-- Post Code -->
                            <li>
                                <span class="Input_Icon fa fa-map-marker"></span>
                                <input class="Numeric-Input" id="update_postcode" type="text" value="<?php if(!empty($row['memberPostCode']))echo $row['memberPostCode'];?>" name="update_postcode" placeholder="Post Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Post Code'" autocomplete="off" maxlength="4" />
                                <?php 
                                    if (isset($_SESSION['errorPostCode'])){
                                        echo '<p class="InputError">Try Again: ' . $_SESSION['errorPostCode'] . "</p>";
                                        unset($_SESSION['errorPostCode']); 
                                    } 
                                ?>
                            </li>
                            
                            
    
                            <!-- Email -->
                            <li>
                                <span class="Input_Icon fa fa-paper-plane"></span>
                                <input id="update_email" type="text" value="<?php if(!empty($row['memberEmail']))echo $row['memberEmail'];?>" name="update_email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" autocomplete="off"/>
                                <?php 
                                    if (isset($_SESSION['errorEmail'])){
                                        echo '<p class="InputError">Try Again: ' . $_SESSION['errorEmail'] . "</p>";
                                        unset($_SESSION['errorEmail']); 
                                    } 
                                ?>
                            </li>
                            
                            <!-- UPDATE DETAILS Button -->
                            <li>
                                <input class="btn" type="submit" name="Update_Details" value="UPDATE DETAILS" />
                            </li>
                            
                        </ul>
                    </form>
                </div>

                <!------------------------------------
                - CHANGE PROFILE PICTURE
                -------------------------------------->
                <div class="Profile_Update_Picture">
                    <h1>Account Profile Picture</h1>
                    
                    <form class="Update-Form Update_Form" name="Profile-Image-Update" action="settings-process.php" method="post" enctype="multipart/form-data">
                        <ul>
                            <li>
                                <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
                            </li>
                            
                            <li>
                                <div class="Profile_Update_Picture_User_Picture circle" <?php echo getProfilePic($_SESSION['login']);?> >
                                </div>
                            </li>
                            
                            <li>
                                <input type="file" name="image" />
                                <?php 
                                    if (isset($_SESSION['errorProfilePicture'])){
                                        echo '<p class="InputError">Error: ' . $_SESSION['errorProfilePicture'] . "</p>";
                                        unset($_SESSION['errorProfilePicture']); 
                                    } 
                                ?>
                            </li>
                            
                            <li>
                                <input class="btn" type="submit" name="Update_Image" value="UPDATE IMAGE" />
                            </li>
                        </ul>
                    </form>
                </div>
            
        </div>

    </body>
</html>
        
        
        
        
        
    