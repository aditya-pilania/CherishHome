const chatbot = document.getElementById('chatbot');
const toggle = document.getElementById('chatbot-toggle');

toggle.addEventListener('click', () => {
  chatbot.style.display = chatbot.style.display === 'none' || chatbot.style.display === '' ? 'flex' : 'none';
});

function sendMessage() {
  const input = document.getElementById('userInput');
  const message = input.value.trim();
  const messagesDiv = document.getElementById('messages');

  if (!message) return;

  // Show user's message
  const userMsg = document.createElement('div');
  userMsg.className = 'message user';
  userMsg.textContent = message;
  messagesDiv.appendChild(userMsg);

  input.value = '';
  messagesDiv.scrollTop = messagesDiv.scrollHeight;

  // Send to Flask bot
  fetch('http://127.0.0.1:5000/chat', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ message: message })
  })
    .then(res => res.json())
    .then(data => {
      const botMsg = document.createElement('div');
      botMsg.className = 'message bot';
      botMsg.textContent = data.response;
      messagesDiv.appendChild(botMsg);
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    })
    .catch(err => {
      const errorMsg = document.createElement('div');
      errorMsg.className = 'message bot';
      errorMsg.textContent = "Oops! Could not talk to the bot.";
      messagesDiv.appendChild(errorMsg);
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
}
const closeBtn = document.getElementById('chat-close');

if (closeBtn) {
  closeBtn.addEventListener('click', () => {
    chatbot.style.display = 'none';
  });
}

