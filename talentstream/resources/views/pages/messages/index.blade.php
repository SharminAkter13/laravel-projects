@extends('master')

@section('page')
<div class="container-fluid m-5 p-5">
    <div class="row">
        <!-- Contact list -->
        <div class="col-md-4 border-end" style="height: 80vh; overflow-y: auto;">
            <h5 class="text-center bg-primary text-white py-2">Chat Contacts</h5>
            <ul id="contactList" class="list-group list-group-flush"></ul>
            <div id="contactError" class="text-danger text-center mt-2" style="display:none;">Error loading contacts.</div>
        </div>

        <!-- Chat area -->
        <div class="col-md-8" style="height: 80vh;">
            <div id="chatHeader" class="p-3 border-bottom">
                <h5 id="chatUserName" class="mb-0 text-muted">Select a contact to start chatting!</h5>
            </div>

            <div id="chatMessages" class="p-3" style="height: 60vh; overflow-y: auto;">
                <div class="text-center text-muted mt-5">
                    <i class="bi bi-chat-dots" style="font-size: 3rem;"></i>
                    <p>Your contacts will appear on the left.</p>
                </div>
            </div>

            <div class="p-3 border-top d-flex">
                <input type="text" id="messageInput" class="form-control me-2" placeholder="Type a message..." disabled>
                <button id="sendButton" class="btn btn-primary" disabled>Send</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const contactList = document.getElementById('contactList');
    const chatUserName = document.getElementById('chatUserName');
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const contactError = document.getElementById('contactError');

    let currentReceiverId = null;
    let conversationId = null;

    // ✅ Load contacts
    fetch('{{ url("/chat/contacts") }}')
        .then(response => response.json())
        .then(data => {
            contactList.innerHTML = '';
            if (!Array.isArray(data) || data.length === 0) {
                contactList.innerHTML = '<li class="list-group-item text-muted text-center">No contacts found</li>';
                return;
            }

            data.forEach(contact => {
                const li = document.createElement('li');
                li.className = 'list-group-item list-group-item-action';
                li.textContent = contact.name;
                li.style.cursor = 'pointer';
                li.addEventListener('click', () => loadMessages(contact));
                contactList.appendChild(li);
            });
        })
        .catch(() => {
            contactError.style.display = 'block';
        });

    // ✅ Load messages for selected contact
    function loadMessages(contact) {
        currentReceiverId = contact.id;
        chatUserName.textContent = contact.name;
        messageInput.disabled = false;
        sendButton.disabled = false;
        chatMessages.innerHTML = '<p class="text-center text-muted">Loading messages...</p>';

        fetch(`/chat/messages/${contact.id}`)
            .then(response => response.json())
            .then(data => {
                conversationId = data.conversation_id;
                chatMessages.innerHTML = '';

                if (!data.messages || data.messages.length === 0) {
                    chatMessages.innerHTML = '<p class="text-center text-muted">No messages yet. Start the conversation!</p>';
                    return;
                }

                data.messages.forEach(msg => {
                    const msgDiv = document.createElement('div');
                    msgDiv.className = msg.sender_id === {{ Auth::id() }} 
                        ? 'text-end mb-2' 
                        : 'text-start mb-2';

                    msgDiv.innerHTML = `
                        <span class="p-2 rounded ${msg.sender_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-light'}">
                            ${msg.message}
                        </span>
                    `;
                    chatMessages.appendChild(msgDiv);
                });

                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }

    // ✅ Send message
    sendButton.addEventListener('click', () => {
        const text = messageInput.value.trim();
        if (!text || !currentReceiverId) return;

        fetch(`/chat/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ receiver_id: currentReceiverId, text })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const msgDiv = document.createElement('div');
                msgDiv.className = 'text-end mb-2';
                msgDiv.innerHTML = `<span class="p-2 rounded bg-primary text-white">${data.message.message}</span>`;
                chatMessages.appendChild(msgDiv);
                messageInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    });
});
</script>
@endsection
