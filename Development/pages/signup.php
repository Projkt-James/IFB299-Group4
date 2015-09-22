<?php
    include '../includes/head.php';
    include '../includes/connect.php';
    
    if (isset($_SESSION['login'])) { 
        header('location:index.php'); 
    }else{
           
    }

    //Webpage Title
    $Title = "Sign Up";

    displayHead($Title);
?>

        <section class="Login-Container center-hoz">

            <form class="LogSign_Form" name="signup" action="signup-process.php" method="post">
                <ul>
                    <!-- LOGO -->
                    <a href="index.php"><li>Sign Up?</li></a>

                    <!-- First Name -->
                    <li>
                        <span class="Input_Icon fa fa-user"></span>
                        <input id="sign_firstname" type="text" value="<?php echo getField('sign_firstname'); ?>" name="sign_firstname" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" autocomplete="off"/>
                        <?php 
                            if (isset($_SESSION['errorFirstName'])){
                                echo '<p class="InputError"> Error: ' . $_SESSION['errorFirstName'] . '</p>';
                                unset($_SESSION['errorFirstName']); 
                            }
                        ?> 
                    </li>

                    <!-- Last Name -->
                    <li>
                        <span class="Input_Icon fa fa-user"></span>
                        <input id="sign_lastname" type="text" value="<?php echo getField('sign_lastname'); ?>" name="sign_lastname" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" autocomplete="off"/>
                        <?php 
                            if (isset($_SESSION['errorLastName'])){
                                echo '<p class="InputError"> Error: ' . $_SESSION['errorLastName'] . '</p>';
                                unset($_SESSION['errorLastName']); 
                            }
                        ?> 
                    </li>

                    <!-- Gender -->
                    <li>
                        <span class="Input_Icon fa fa-heart"></span>
                        <span class="Input_Hide"></span>
                        <select id="sign_gender" name="sign_gender">
                            <option value="1" disabled selected>Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <?php 
                            if (isset($_SESSION['errorGender'])){
                                echo '<p class="InputError">Error: ' . $_SESSION['errorGender'] . "</p>";
                                unset($_SESSION['errorGender']); 
                            } 
                        ?>
                    </li>

                    <!-- Country -->
                    <li>
                        <span class="Input_Icon fa fa-globe"></span>
                        <span class="Input_Hide"></span>
                        <select id="sign_country" name="sign_country">
                            <div>
                            <option value="default" disabled selected>Select A Country</option>       
                            <?php
                                $sql = "SELECT * FROM country";
                                $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 

                                while ($row = mysqli_fetch_array($result)){
                                    echo '<option value="'. $row['countryID'] .'">'. $row['country'] .'</option>';   
                                }
                            ?>
                            </div>
                        </select>
                        <?php 
                            if (isset($_SESSION['errorCountry'])){
                                echo '<p class="InputError">Error: ' . $_SESSION['errorCountry'] . "</p>";
                                unset($_SESSION['errorCountry']); 
                            } 
                        ?>
                    </li>

                    <!-- Post Code -->
                    <li>
                        <span class="Input_Icon fa fa-map-marker"></span>
                        <input id="sign_postcode" type="text" value="<?php echo getField('sign_postcode'); ?>" name="sign_postcode" placeholder="Post Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Post Code'" autocomplete="off" maxlength="4" />
                        <?php 
                            if (isset($_SESSION['errorPostCode'])){
                                echo '<p class="InputError"> Error: ' . $_SESSION['errorPostCode'] . '</p>';
                                unset($_SESSION['errorPostCode']); 
                            }
                        ?> 
                    </li>

                    <!-- Email -->
                    <li>
                        <span class="Input_Icon fa fa-paper-plane"></span>
                        <input id="sign_email" type="text" value="<?php echo getField('sign_email'); ?>" name="sign_email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" autocomplete="off"/>
                        <?php 
                            if (isset($_SESSION['errorEmail'])){
                                echo '<p class="InputError"> Error: ' . $_SESSION['errorEmail'] . '</p>';
                                unset($_SESSION['errorEmail']); 
                            }
                        ?> 
                    </li>

                    <!-- Username -->
                    <li>
                        <span class="Input_Icon fa fa-child"></span>
                        <input id="sign_username "type="text" value="<?php echo getField('sign_username'); ?>" name="sign_username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" autocomplete="off"/>
                        <?php 
                            if (isset($_SESSION['errorUser'])){
                                echo '<p class="InputError"> Error: ' . $_SESSION['errorUser'] . '</p>';
                                unset($_SESSION['errorUser']); 
                            }
                        ?> 
                    </li>

                    <!-- Password -->
                    <li>
                        <span class="Input_Icon fa fa-lock"></span>
                        <input id="sign_password" type="password" name="sign_password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"/>
                        <?php 
                            if (isset($_SESSION['errorPass'])){
                                echo '<p class="InputError">Error: ' . $_SESSION['errorPass'] . "</p>";
                                unset($_SESSION['errorPass']); 
                            } 
                        ?>
                    </li>

                    <!-- SIGN UP Button -->
                    <li>
                        <input class="btn" id="submit" type="submit" name="submit" value="SIGN UP" hidefocus="hidefocus">
                    </li>

                    <li>
                        <a href="login.php">Already Have An Account?&nbsp;&nbsp;<span class="fa fa-angle-down"></span></a>
                    </li>
                </ul>
            </form>

        </section>



    </body>
</html>