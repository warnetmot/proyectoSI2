@extends('adminlte::page')

@section('title', 'Asistente Virtual - Estudio de Tatuajes')

@section('content_header')
    <h1 class="text-center"><i class="fas fa-robot mr-2"></i>Asistente Virtual del Estudio</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Chat con el asistente</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <div class="direct-chat-messages" id="chat-box" style="height: 400px;">
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Asistente</span>
                            <span class="direct-chat-timestamp float-right">{{ now()->format('H:i') }}</span>
                        </div>
                        <img class="direct-chat-img" src="{{ asset('vendor\adminlte\dist\img\bot.png') }}" alt="Asistente">
                        <div class="direct-chat-text">
                            ¡Hola! Soy tu asistente del estudio de tatuajes. ¿En qué puedo ayudarte hoy?
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="input-group">
                    <input type="text" id="chat-message" name="message" placeholder="Escribe tu mensaje..." 
                           class="form-control" autocomplete="off" onkeypress="if(event.keyCode == 13) sendMessage()">
                    <span class="input-group-append">
                        <button type="button" onclick="sendMessage()" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .direct-chat-messages {
        transform: scale(1);
        transition: all .5s;
        overflow-y: auto;
        padding: 10px;
        background-color: #f8f9fa;
    }
    
    .direct-chat-text {
        border-radius: 15px;
        padding: 10px 15px;
        background: #d2d6de;
        border: none;
        margin: 5px 0 0 50px;
        color: #444;
        position: relative;
    }
    
    .direct-chat-text:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -10px;
        right: auto;
        top: 0;
        bottom: auto;
        border: 10px solid transparent;
        border-right-color: #d2d6de;
        border-left: 0;
    }
    
    .right .direct-chat-text {
        margin-right: 50px;
        margin-left: 0;
        background: #007bff;
        color: #fff;
    }
    
    .right .direct-chat-text:after {
        left: auto;
        right: -10px;
        border-right-color: transparent;
        border-left-color: #007bff;
    }
    
    .direct-chat-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    
    .direct-chat-msg {
        margin-bottom: 15px;
        display: flex;
    }
    
    .direct-chat-infos {
        display: block;
        margin-bottom: 5px;
        font-size: 0.875rem;
    }
    
    .direct-chat-name {
        font-weight: 600;
    }
    
    .direct-chat-timestamp {
        color: #6c757d;
    }
    
    .right {
        flex-direction: row-reverse;
    }
    
    /* Animación para nuevos mensajes */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .new-message {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@stop

@section('js')
<script>
    function sendMessage() {
        const messageInput = document.getElementById('chat-message');
        const message = messageInput.value.trim();
        const chatBox = document.getElementById('chat-box');

        if (message === '') return;

        // Agregar mensaje del usuario con estilo y animación
        const userMessage = document.createElement('div');
        userMessage.className = 'direct-chat-msg right new-message';
        userMessage.innerHTML = `
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-right">Tú</span>
                <span class="direct-chat-timestamp float-left">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
            </div>
            <img class="direct-chat-img" src="{{ Auth::user()->profile_photo_url ?? asset('vendor/adminlte/dist/img/logo1.jpg') }}" alt="Usuario">
            <div class="direct-chat-text">${message}</div>
        `;
        chatBox.appendChild(userMessage);
        
        // Limpiar input y mantener el foco
        messageInput.value = '';
        messageInput.focus();
        
        // Scroll al final
        chatBox.scrollTop = chatBox.scrollHeight;
        
        // Mostrar estado "escribiendo..."
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'direct-chat-msg new-message';
        typingIndicator.innerHTML = `
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">Asistente</span>
                <span class="direct-chat-timestamp float-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
            </div>
            <img class="direct-chat-img" src="{{ asset('vendor/adminlte/dist/img/bot.png') }}" alt="Asistente">
            <div class="direct-chat-text">
                <i class="fas fa-circle-notch fa-spin"></i> Escribiendo...
            </div>
        `;
        chatBox.appendChild(typingIndicator);
        chatBox.scrollTop = chatBox.scrollHeight;
        
        // Enviar al servidor
        fetch("{{ route('admin.chatbot.respond') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message })
        })
        .then(response => {
            // Eliminar el indicador "escribiendo"
            chatBox.removeChild(typingIndicator);
            
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            // Agregar respuesta del bot con estilo y animación
            const botMessage = document.createElement('div');
            botMessage.className = 'direct-chat-msg new-message';
            botMessage.innerHTML = `
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">Asistente</span>
                    <span class="direct-chat-timestamp float-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('vendor/adminlte/dist/img/bot.png') }}" alt="Asistente">
                <div class="direct-chat-text">${data.response.replace(/\n/g, '<br>')}</div>
            `;
            chatBox.appendChild(botMessage);
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            chatBox.removeChild(typingIndicator);
            
            const errorMessage = document.createElement('div');
            errorMessage.className = 'direct-chat-msg new-message';
            errorMessage.innerHTML = `
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">Asistente</span>
                    <span class="direct-chat-timestamp float-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('vendor/adminlte/dist/img/bot.png') }}" alt="Asistente">
                <div class="direct-chat-text">Lo siento, hubo un error al procesar tu mensaje. Por favor, inténtalo de nuevo.</div>
            `;
            chatBox.appendChild(errorMessage);
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    }
    
    // Opcional: Auto-enfoque en el input al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('chat-message').focus();
    });
</script>
@stop