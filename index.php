<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If user is logged in, fetch their details from the database and pre-fill the form fields
    $username = $_SESSION['username'];

    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'travaldb');

    // Fetch user details from the database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['username']; // Assuming 'username' is the field in the users table
        $email = $row['email']; // Assuming 'email' is the field in the users table
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour & Travel</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <header class="header">
        <a href="" class="heading">Bharatdarshan.com</a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#category">Adventures</a>
            <a href="#packages">packages</a>
            <a href="#contact">contact</a>
            <?php
            // session_start();
            if (isset($_SESSION['username'])) {
                // User is logged in, display username and logout option
                echo '<span style="background-color: black; color: white;  font-size: 15px;"> welcome ' . $_SESSION['username'] . '</span>';
                echo '<a href="?logout=true">Logout</a>';

                // Display JavaScript alert after successful login
                if (!isset($_SESSION['alert_shown'])) {
                    echo '<script>alert("Welcome to Bharatdarshan!");</script>';
                    $_SESSION['alert_shown'] = true;
                }


            } else {
                // User is not logged in, display login option
                echo '<a href="Register.php" id="login">Register</a>';
                echo '<a href="admin.php">Admin</a>';
            }


            // Destroy session on logout
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Location: logout.php"); // Redirect to login page after logout
                exit();
            }
            ?>

        </nav>
    </header>


    <section class="home" id="home">

        <div class="wrapper">

            <div class="box" style="background: url(image/mainpage/bg4.png);">

                <div class="content">
                    <span>Beyond Boundaries</span>
                    <h3>Never stop </h3><br>
                    <p>Bharatdarshan.com</p>
                    <p>Explore India's Essence</p><br>
                    <a href="#category" class="btn" style="color:gold;">get started</a>

                </div>
            </div>
        </div>
    </section>

    <!-- Adventure section -->

    <section class="category" id="category">

        <h1 class="heading">Adventure Things To Do In Life!</h1>

        <div class="box-container">


            <div class="box">
                <img src="image/adventure/img20.png" alt=" rafting ">
                <h3>Rafting</h3>
                <p>Uttarakhand, with gurgling rivers like Ganga, Yamuna, Alaknanda, Tons, Kali, Kosi and many more, is
                    the ultimate white water rafting destination</p>
                <a href="https://en.wikipedia.org/wiki/Bungee_jumping" class="btn" style="color: blue;">read more</a>
            </div>

            <div class="box">
                <img src="image/adventure/img21.png" alt="Rock climbing">
                <h3>Rock climbing</h3>
                <p>Rock climbing is a sport in which participants climb up, across, or down natural rock formations or
                    indoor climbing walls. The goal is to reach the summit of a formation or the endpoint of a usually
                    pre-defined route without falling.</p>
                <a href="https://en.wikipedia.org/wiki/Rishikesh" class="btn" style="color: blue;">read more</a>
            </div>

            <div class="box">
                <img src="image/adventure/img22.png" alt="Scuba Diving">
                <h3>Scuba diving</h3>
                <p>Scuba diving is a mode of underwater diving whereby divers use breathing equipment that is completely
                    independent of a surface breathing gas supply, and therefore has a limited but variable endurance.
                </p>
                <a href="https://en.wikipedia.org/wiki/Scuba_diving" class="btn" style="color: blue;">read more</a>
            </div>

            <div class="box">
                <img src="image/adventure/img23.png" alt="Skydiving">
                <h3>Skydiving</h3>
                <p>Skydiving is parachuting (jumping) from an airplane for fun. Skydiving can be done individually and
                    with groups of people. Training is required. Unlike most paratroopers, skydivers often wait until
                    they are low, before opening the parachute</p>
                <a href="https://simple.wikipedia.org/wiki/Skydiving" class="btn" style="color: blue;">read more</a>
            </div>

            <div><a href="adventure.php" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click
                    for more</a></div>
        </div>

    </section>
    <section class="packages" id="packages">

        <h1 class="heading">popular places And packages</h1>

        <div class="box-container">

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/ram mandir.png" alt="">
                </div>
                <div id="content1" class="content">
                    <h3><a href="#">Ayodhya Ram Mandir</a></h3>
                    <p>The Ram Mandir (lit. 'Rama Temple') is a partially constructed Hindu temple complex in Ayodhya,
                        Uttar Pradesh, India. Many Hindus believe that it is located at the site of Ram Janmabhoomi, the
                        mythical birthplace of Rama, a principal deity of Hinduism. The temple was inaugurated on 22
                        January 2024 after a prana pratishtha (consecration) ceremony.</p>
                    <br>
                   
                    <!-- HTML code for the explore now link -->
                    <?php
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        // User is logged in
                        echo '<div><a href="back1.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                    } else {
                    }
                    ?>


                    <!-- JavaScript code to populate the Packages field with the selected place name or empty string -->
                    <script>
                        // Function to populate the Packages field with the selected place name or empty string
                        function populatePackages(placeName = '') {
                            // Get the input field for packages
                            var packagesInput = document.querySelector('input[name="packages"]');

                            // Set the value of the packages input field to the selected place name or empty string
                            packagesInput.value = placeName;
                        }
                    </script>

                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/Chardham-Yatra.png" alt="">
                </div>
                <div id="content2" class="content">
                    <h3><a href="">Char Dham Yatra</a> </h3>
                    <p>Uttarakhand is known as Dev Bhoomi (Land of Gods), as it is the land of great pilgrimages, sacred
                        temples and places, which attracts millions of pilgrims and spiritual seekers to get
                        enlightenment.
                        These four ancient temples also marks the spiritual source of four sacred rivers as well: River
                        Yamuna (Yamunotri), River Ganga or Ganges (Gangotri), River Mandakini (Kedarnath) and River
                        Alaknanda (Badrinath).</p>
                   
                    <div class="content">
                        <div class="conent">
                            <h1>This are the char dham Yatra's </h1>
                            <h3>
                                <a target="_blank" href="https://www.sacredyatra.com/yamunotri" class="btn">Yamunotri
                                    Dham</a>
                            </h3>
                            <h3>
                                <a target="_blank" href="https://www.sacredyatra.com/yamunotri" class="btn">Gangotri
                                    Dham </a>
                            </h3>
                            <h3>
                                <a target="_blank" href="https://www.sacredyatra.com/yamunotri" class="btn">Kedarnath
                                    Dham</a>
                            </h3>
                            <h3>
                                <a target="_blank" href="https://www.sacredyatra.com/yamunotri" class="btn">Badrinath
                                    Dham</a>
                            </h3>

                            <!-- HTML code for the explore now link -->
                            <?php
                            // session_start();
                            if (isset($_SESSION['username'])) {
                                // User is logged in
                                echo '<div><a href="back2.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                            } else {
                            }
                            ?>


                            <!-- JavaScript code to populate the Packages field with the selected place name or empty string -->
                            <script>
                                // Function to populate the Packages field with the selected place name or empty string
                                function populatePackages(placeName = '') {
                                    // Get the input field for packages
                                    var packagesInput = document.querySelector('input[name="packages"]');

                                    // Set the value of the packages input field to the selected place name or empty string
                                    packagesInput.value = placeName;
                                }
                            </script>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/taj m.jpg" alt="">
                </div>
                <div id="content3" class="content">
                    <h3>Taj Mahal</h3>
                    <p>The Taj Mahal was designated as a UNESCO World Heritage Site in 1983 for being “the jewel of
                        Muslim art in India and one of the universally admired masterpieces of the world's heritage”. It
                        is regarded by many as the best example of Mughal architecture and a symbol of India's rich
                        history.</p>
                   
                    <?php
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        // User is logged in
                        echo '<div><a href="back3.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                    } else {
                    }
                    ?>


                    <!-- JavaScript code to populate the Packages field with the selected place name or empty string -->
                    <script>
                        // Function to populate the Packages field with the selected place name or empty string
                        function populatePackages(placeName = '') {
                            // Get the input field for packages
                            var packagesInput = document.querySelector('input[name="packages"]');

                            // Set the value of the packages input field to the selected place name or empty string
                            packagesInput.value = placeName;
                        }
                    </script>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/shimla.png" alt="">
                </div>
                <div id="content4" class="content">
                    <h3>Shimla</h3>

                    <p>Shimla is the capital of the northern Indian state of Himachal Pradesh, in the Himalayan
                        foothills. Once the summer capital of British India, it remains the terminus of the narrow-gauge
                        Kalka-Shimla Railway, completed in 1903. </p>
                    


                    <?php
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        // User is logged in
                        echo '<div><a href="back4.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                    } else {
                    }
                    ?>


                    <!-- JavaScript code to populate the Packages field with the selected place name or empty string -->
                    <script>
                        // Function to populate the Packages field with the selected place name or empty string
                        function populatePackages(placeName = '') {
                            // Get the input field for packages
                            var packagesInput = document.querySelector('input[name="packages"]');

                            // Set the value of the packages input field to the selected place name or empty string
                            packagesInput.value = placeName;
                        }
                    </script>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/katra.png" alt="no image">
                </div>
                <div id="content5" class="content">
                    <h3>Mata Vaishno Devi, Katra</h3>
                    <p>Matavaishnodevi.com has been designed and developed to provide Mata Vaishnodevi's Bhakats
                        complete information about the Holy Shrine and make their pilgrimage comfortable and
                        unforgettable experience.</p>
                    
                    <!-- HTML code for the explore now link -->
                    <?php
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        // User is logged in
                        echo '<div><a href="back5.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                    } else {
                    
                    }
                    ?>

                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="image/PopularPlaces/ladak.png" alt="">
                </div>
                <div id="content6" class="content">
                    <h3>Ladakh</h3>
                    <p>Ladakh is a region administered by India as a union territory and constitutes an eastern portion
                        of the larger Kashmir region that has been the subject of a dispute between India and Pakistan
                        since 1947 and India and China since 1959.</p>
                    
                    <!-- HTML code for the explore now link -->
                    <?php
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        // User is logged in
                        echo '<div><a href="back6.html" class="btn" style="border: 0.2rem solid black; color: rgb(101, 52, 174);">click to  Explore </a></div>';
                    } else {
                    
                    }
                    ?>


                    <!-- JavaScript code to populate the Packages field with the selected place name or empty string -->
                    <script>
                        // Function to populate the Packages field with the selected place name or empty string
                        function populatePackages(placeName = '') {
                            // Get the input field for packages
                            var packagesInput = document.querySelector('input[name="packages"]');

                            // Set the value of the packages input field to the selected place name or empty string
                            packagesInput.value = placeName;
                        }
                    </script>
                </div>
            </div>

            <div><a href="more.html" class="btn" style="border: 0.2rem solid blue; color: rgb(101, 52, 174);">click
                    for more</a></div>


        </div>

    </section>
    <section class="contact" id="contact">
        <div class="wrapper1">
            <div class="title1" id="contact">
                <h1>Contact us</h1>
            </div>
            <div class="contact-form">
                <form method="post" action="contact_us.php">
                    <div class="input-fields">
                        <input type="text" class="input" placeholder="Name" name="name"
                            value="<?php echo isset($name) ? $name : ''; ?>" required>
                        <input type="email" class="input" placeholder="Email Address" name="email"
                            value="<?php echo isset($email) ? $email : ''; ?>" required <?php echo isset($email) ? 'readonly' : ''; ?>>
                        <?php if (isset($email))
                            echo '<small style="color: red;">This is your registered email. Cannot be changed.</small>'; ?>
                        <input type="phone" class="input" placeholder="Mobile Number" name="phone" required>
                        <input type="text" class="input" placeholder="Enter your packages" name="packages" required>
                    </div>

                    <!-- Your PHP code for showing submit button or login message -->
                    <div class="msg">
                        <textarea placeholder="Write your Requirement's" name="message" required></textarea> <br>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // User is logged in, display the submit button
                            echo '<div class="btn1"><button type="submit">Submit <i class="uil uil-message"></i></button></div>';
                        } else {
                            // User is not logged in, display a message or redirect to the login page
                            echo '<div style="padding: 7px; background-color: white; border: 2px solid black; border-radius: 3px;font-size: 16px;"><strong> Please   <a href="login.php">login</a>To Explore </strong></div>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Quick links</h3>
                <a href="#home">home</a>
                <a href="#packages">packages</a>
                <a href="#category">Adventure Things</a>
                <a href="history.php">history</a>

            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#contact">Ask Any Question?</a>
                <a href="policy.html">policy</a>
                <a href="terms.html">Terms of use</a>
                <a href="feedback.html">feedback</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="tel:+916305950923"> <i class="fas fa-phone"></i> +91 6305950923 </a>
                <a href="mailto: gajrebalraj34@gmail.com"> <i class="fas fa-envelope"></i> gajrebalraj34@gmail.com </a>
                <a href="https://en.wikipedia.org/wiki/Hyderabad" ,> <i class="fas fa-map"></i> Hyderabad, india -
                    500006 </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="https://www.facebook.com/yash.srivastav0"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="https://www.instagram.com/its_me_danger_bird?igsh=MWg1ODFrOWRkcnEzbg=="> <i
                        class="fab fa-instagram"></i> instagram </a>
                <!-- <a href="https://www.linkedin.com/in/yash-srivastav/"> <i class="fab fa-linkedin"></i> linkedin </a> -->
                <!-- <a href="https://github.com/Yash-srivastav16"> <i class="fab fa-github"></i> github </a> -->
            </div>


        </div>
        <div class="credit">created by <a href="">Gajre Balraj</a> | all rights reserved!</div>
    </section>
    <!-- footer section ends -->
    <script src="js/script.js"></script>




</html>