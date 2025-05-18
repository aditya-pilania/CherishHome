<?php include './components/header.php'; ?>

    <div class="ui container">

        <!-- Top Navigation Bar -->
        <?php include './components/top-menu.php'; ?>

        <!-- BODY Content -->
        <div class="ui grid">
            <!-- Left menu -->
            <?php include './components/side-menu.php'; ?>
            
            <!-- right content -->
            <div class="twelve wide column">
                <h1>CHERISH HOME</h1>
                <h3>Cherish Home, a place where you will live, laugh and love.</h3>
                <p><strong>Cherish Home</strong> is a non-profit, non-government and voluntary organization committed to the care & development and voluntary organization committed to the care and development of the underprivileged children.</p>
                <p><strong>Cherish Home is a group</strong> of quanlified, hardworking, dedicated, like-minded people trying to make a difference in the life of the underrepresented, disadvantaged and marginalized sections of the society. It have been established to work as a platform to channelize and make optimum use of the resources and infrastructure available and people's desire to give back to society a bit of what they owe to it.</p>
                <p><strong>It is out effort</strong> at Cherish Home to guide and motivate people to use their resources in a construction in changing the lives of these street children.</p>                <p><strong>We are working</strong> in the field of education and over all development of the destitute children by providing then with an opportunity to realize their full potentials and lead a dignified and respectable life.</p>

                <div class="ui medium center images" style="text-align: center;">
                    <img style="width: 400px; height: 280px;" class="ui medium rounded image" src="./img/children-1.jpg">
                    <img style="width: 400px; height: 280px;" class="ui medium rounded image" src="./img/children-2.jpg">
                </div>

                <span class="p-20"></span>
            </div>
        </div>

    </div>
    <!-- Floating Chatbot Button -->
<div id="chatbot-btn">
  <image src="https://img.icons8.com/ios-filled/50/ffffff/chat.png" alt="Chatbot Icon" />
</div>

<!-- Chatbot Popup -->
<div id="chat-popup">
  <div class="chat-header">
    Chat with us
    <span id="chat-close">&times;</span>
  </div>
  <iframe src="/CherishHome/chatbot/chatbot.php"></iframe>
</div>
<script>
  const chatbotBtn = document.getElementById("chatbot-btn");
  const chatPopup = document.getElementById("chat-popup");
  const chatClose = document.getElementById("chat-close");

  chatbotBtn.addEventListener("click", () => {
    chatPopup.style.display = "flex";
  });

  chatClose.addEventListener("click", () => {
    chatPopup.style.display = "none";
  });
</script>
<link rel="stylesheet" href="chatbot/chatbot.css">
<?php include './components/footer.php'; ?>