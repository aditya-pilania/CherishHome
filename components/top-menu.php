        <!-- Top Navigation Bar -->
        <div class="ui black inverted menu">
            <div class="header item">
                Cherish Home
            </div>
            <a class="item" href="index.php">Home</a>
            <a class='item' href="calendar/calendar.php">Calendar</a>
            <!-- <a class="item" href="chatbot/chatbot.php"><button id="chatbot-toggle">💬</button></a> -->
            <div class="right menu">

                <?php
                    if (empty($_SESSION['user_id'])) { 
                ?>
                        <a href="login.php" class="item <?php echo ($_SERVER['PHP_SELF'] == "/orphan/login.php" ? "active" : "");?>">Login</a>
                <?php
                    } else { 
                ?>
                        <a href="admin/index.php" class="item">Admin Panel</a>
                        <a href="logout.php" class="item">Logout</a>
                <?php
                    } 
                ?>

            </div>
        </div>