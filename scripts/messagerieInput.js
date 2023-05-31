let messageInput = document.getElementById("message-text");

messageInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        newMsg();
    
        messageInput.value = "";
    }
});
