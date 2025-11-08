@extends('master')

@section('page')
<div class="container-fluid py-4 h-100">
    <div id="app-container" class="bg-white rounded-3 shadow-lg overflow-hidden d-flex flex-column flex-md-row" style="min-height: 80vh;">
        <!-- Sidebar (Contacts) -->
        <div class="col-md-3 bg-light border-end d-flex flex-column" style="min-width: 250px;">
            <div class="p-3 border-bottom bg-primary text-white shadow-sm">
                <h3 class="h5 fw-bold mb-1">Chat Contacts</h3>
                <p class="small m-0 text-white opacity-75">{{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
            </div>
            <div id="contact-list" class="flex-grow-1 overflow-y-auto">
                <div class="p-4 text-secondary small">Loading contacts...</div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div id="main-chat" class="col-md-9 d-flex flex-column">
            <div id="chat-header" class="p-3 border-bottom bg-white shadow-sm">
                <h3 class="h5 fw-bold text-secondary m-0">Select a contact to start chatting!</h3>
            </div>
            <div id="chat-content" class="flex-grow-1 d-flex align-items-center justify-content-center bg-light p-4">
                <div class="text-secondary text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots d-block mx-auto mb-2" viewBox="0 0 16 16">
                        <path d="M5 13H1.5a.5.5 0 0 1 0-1H5v1zm6.5 0h-2a.5.5 0 0 1 0-1h2v1zM11 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m0 2v1h1v-1z"/>
                        <path d="M12.186 16c-.722 0-1.12.355-1.189.593-.11.378.118.823.5 1.096.345.244.757.382 1.258.382 1.34 0 2.2-.67 2.2-2.176 0-1.177-.662-1.93-1.636-2.126.96-.28 1.57-.96 1.57-1.898 0-1.29-.86-2.115-1.895-2.115-.815 0-1.378.375-1.618.73-.257.387-.197.87.168 1.137.318.238.74.37 1.258.37 1.11 0 1.63.498 1.63 1.328 0 .848-.485 1.323-1.282 1.323-.465 0-.825-.133-1.155-.38l-.134-.1-.137-.095c-.347-.238-.6-.395-1.01-.395-.91 0-1.46.61-1.46 1.48 0 .89.59 1.48 1.46 1.48.51 0 .85-.14 1.15-.38z"/>
                    </svg>
                    <p>Your contacts will appear on the left.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Axios CDN --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
const userId = {{ auth()->id() }};
let currentReceiver = null;

// Load contacts on page load
document.addEventListener('DOMContentLoaded', loadContacts);

// Fetch contacts
function loadContacts() {
    axios.get('/chat/contacts')
        .then(res => {
            const contacts = res.data;
            const list = document.getElementById('contact-list');
            if (!contacts.length) {
                list.innerHTML = `<div class="p-4 text-secondary small">No contacts available.</div>`;
                return;
            }

            let html = '<div class="list-group list-group-flush">';
            contacts.forEach(c => {
                html += `
                    <button type="button" class="list-group-item list-group-item-action border-bottom"
                        data-id="${c.id}" data-name="${c.name}">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle fw-bold d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                ${c.name.charAt(0).toUpperCase()}
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark">${c.name}</div>
                                <div class="small text-secondary">${c.role}</div>
                            </div>
                        </div>
                    </button>`;
            });
            html += '</div>';
            list.innerHTML = html;

            // Add click listeners
            list.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', () => openChat(btn.dataset.id, btn.dataset.name));
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById('contact-list').innerHTML = `<div class="p-4 text-danger small">Error loading contacts.</div>`;
        });
}

// Open a chat with selected contact
function openChat(id, name) {
    currentReceiver = id;
    document.getElementById('chat-header').innerHTML = `<h5 class="fw-bold text-dark m-0">${name}</h5>`;
    document.getElementById('chat-content').innerHTML = `
        <div id="chat-history" class="flex-grow-1 p-4 overflow-y-auto"></div>
        <div class="p-3 bg-white border-top">
            <div class="input-group">
                <input type="text" id="message-input" class="form-control rounded-start-pill shadow-sm" placeholder="Type a message..." />
                <button id="send-btn" class="btn btn-primary rounded-end-pill shadow-sm">Send</button>
            </div>
        </div>
    `;
    loadMessages(id);
    attachSendHandler();
}

// Load existing messages
function loadMessages(otherId) {
    axios.get(`/chat/messages/${otherId}`)
        .then(res => {
            const messages = res.data.messages || [];
            const chatHistory = document.getElementById('chat-history');
            if (!messages.length) {
                chatHistory.innerHTML = '<div class="text-center text-secondary mt-4">No messages yet.</div>';
                return;
            }
            chatHistory.innerHTML = messages.map(msg => renderMessage(msg, msg.sender_id === userId)).join('');
            chatHistory.scrollTop = chatHistory.scrollHeight;
        })
        .catch(err => console.error('Error loading messages:', err));
}

// Send new message
function attachSendHandler() {
    const input = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', e => {
        if (e.key === 'Enter') sendMessage();
    });
}

function sendMessage() {
    const input = document.getElementById('message-input');
    const text = input.value.trim();
    if (!text || !currentReceiver) return;

    axios.post('/chat/send', { receiver_id: currentReceiver, text })
        .then(res => {
            const msg = res.data.message;
            appendMessage(msg, true);
            input.value = '';
        })
        .catch(err => console.error('Send error:', err));
}

// Render single message
function renderMessage(msg, isMine) {
    const alignment = isMine ? 'justify-content-end' : 'justify-content-start';
    const bg = isMine ? 'bg-primary text-white' : 'bg-light border';
    const sender = isMine ? 'You' : (msg.sender?.name || 'User');
    const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    return `
        <div class="d-flex ${alignment} mb-3">
            <div class="rounded-3 p-3 shadow-sm ${bg}" style="max-width: 75%;">
                <div class="fw-bold small mb-1 ${isMine ? 'text-white-50' : 'text-secondary'}">${sender}</div>
                <div class="small">${msg.message}</div>
                <div class="text-end small mt-1 ${isMine ? 'text-white-50' : 'text-secondary'}">${time}</div>
            </div>
        </div>
    `;
}

// Append message to chat
function appendMessage(msg, isMine) {
    const chatHistory = document.getElementById('chat-history');
    chatHistory.insertAdjacentHTML('beforeend', renderMessage(msg, isMine));
    chatHistory.scrollTop = chatHistory.scrollHeight;
}
</script>

<style>
#contact-list { max-height: 70vh; }
#chat-history { height: 60vh; overflow-y: auto; }
</style>
@endsection
