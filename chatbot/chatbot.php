<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chatbot</title>
  <link rel="stylesheet" href="chatbot.css">
</head>
<body>



<!-- Chatbot Window -->
<div id="chatbot">
 
  <div id="messages">
    <div class="message bot">
      Hi there 👋<br>How can I help you today?
    </div>
  </div>
  <div id="chat-input">
    <input type="text" id="userInput" placeholder="Type a message..." />
    <button onclick="sendMessage()">➤</button>
  </div>
</div>


<script src="chatbot.js"></script>
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


</body>
</html>
