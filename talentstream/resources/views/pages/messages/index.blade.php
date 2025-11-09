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

<meta name="csrf-token" content="{{ csrf_token() }}">

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

    // Load contacts with unread count
    function loadContacts() {
        fetch('{{ url("/chat/contacts") }}')
            .then(res => res.json())
            .then(data => {
                contactList.innerHTML = '';
                if (!Array.isArray(data) || !data.length) {
                    contactList.innerHTML = '<li class="list-group-item text-center text-muted">No contacts found</li>';
                    return;
                }

                data.forEach(contact => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                    li.style.cursor = 'pointer';
                    li.addEventListener('click', () => loadMessages(contact));
                    li.innerHTML = `
                        <span>${contact.name}</span>
                        ${contact.unread_count > 0 ? `<span class="badge bg-danger rounded-pill">${contact.unread_count}</span>` : ''}
                    `;
                    contactList.appendChild(li);
                });
            })
            .catch(() => { contactError.style.display = 'block'; });
    }

    loadContacts(); // initial load

    // Load messages for a contact
    function loadMessages(contact) {
        currentReceiverId = contact.id;
        chatUserName.textContent = contact.name;
        messageInput.disabled = false;
        sendButton.disabled = false;
        chatMessages.innerHTML = '<p class="text-center text-muted">Loading messages...</p>';

        fetch(`/chat/messages/${contact.id}`)
            .then(res => res.json())
            .then(data => {
                conversationId = data.conversation_id;
                chatMessages.innerHTML = '';

                // Mark messages as read
                if (conversationId) {
                    fetch(`/chat/${conversationId}/read`, {
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
                    }).then(() => {
                        // Remove badge from contact list
                        const li = Array.from(contactList.children).find(li => li.textContent.includes(contact.name));
                        if (li) {
                            const badge = li.querySelector('.badge');
                            if (badge) badge.remove();
                        }

                        // Decrement navbar unread count
                        const navBadge = document.querySelector('#navbarDropdownMessages .badge.bg-danger');
                        if (navBadge) {
                            let current = parseInt(navBadge.textContent);
                            navBadge.textContent = Math.max(0, current - (contact.unread_count || 0));
                            if (parseInt(navBadge.textContent) === 0) navBadge.remove();
                        }
                    });
                }

                if (!data.messages.length) {
                    chatMessages.innerHTML = '<p class="text-center text-muted">No messages yet. Start the conversation!</p>';
                    return;
                }

                data.messages.forEach(msg => {
                    const msgDiv = document.createElement('div');
                    msgDiv.className = msg.sender_id === {{ Auth::id() }} ? 'text-end mb-2' : 'text-start mb-2';
                    msgDiv.innerHTML = `<span class="p-2 rounded ${msg.sender_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-light'}">${msg.message}</span>`;
                    chatMessages.appendChild(msgDiv);
                });

                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }

    // Send message
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
        .then(res => res.json())
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

    // Real-time notifications via Echo
    @if(Auth::check())
    Echo.private('chat.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
            // Navbar badge
            let badge = document.querySelector('#navbarDropdownMessages .badge.bg-danger');
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle';
                badge.textContent = '1';
                document.querySelector('#navbarDropdownMessages').appendChild(badge);
            } else {
                badge.textContent = parseInt(badge.textContent) + 1;
            }

            // Contact badge
            const li = Array.from(contactList.children).find(li => li.textContent.includes(e.message.sender.name));
            if (li) {
                let contactBadge = li.querySelector('.badge');
                if (contactBadge) {
                    contactBadge.textContent = parseInt(contactBadge.textContent) + 1;
                } else {
                    const span = document.createElement('span');
                    span.className = 'badge bg-danger rounded-pill';
                    span.textContent = 1;
                    li.appendChild(span);
                }
            }
        });
    @endif

});
</script>
@endsection
