@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Conversations List -->
            <div class="col-md-4 border-end">
                <h5 class="mb-3">المحادثات</h5>
                <ul class="list-group">
                    @foreach ($conversations as $conversation)
                        @php
                            $isActive = isset($recipientId) && $recipientId == $conversation['user']->id;
                        @endphp
                        <li class="list-group-item {{ $isActive ? 'active' : '' }}">
                            <a href="{{ route('messages.chat', $conversation['user']->id) }}"
                                class="text-decoration-none text-dark">
                                {{ $conversation['user']->name }}
                                @if ($conversation['unread_count'] > 0)
                                    <span class="badge bg-danger float-end">{{ $conversation['unread_count'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>

            <!-- Messages Area -->
            <div class="col-md-8">
                @if ($recipient)
                    <h5 class="mb-3">المحادثة مع: {{ $recipient->fullName }}</h5>
                    <div class="border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;" id="messages-box">
                        @foreach ($messages as $msg)
                            <div class="mb-2">
                                <strong>{{ $msg->sender->id == auth()->id() ? 'أنت' : $msg->sender->name }}:</strong>
                                @if ($msg->message)
                                    <p>{{ $msg->message }}</p>
                                @endif

                                @if ($msg->image)
                                    <p><img src="{{ asset('storage/' . $msg->image) }}" width="150"></p>
                                @endif

                                @if ($msg->voice_note)
                                    <p><audio controls src="{{ asset('storage/' . $msg->voice_note) }}"></audio></p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Send Message -->
                    <form action="{{ route('messages.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
                        <div class="mb-3">
                            <textarea name="message" class="form-control" placeholder="اكتب رسالتك..."></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>أو سجل ملاحظة صوتية:</label>
                            <input type="hidden" name="voice_note_data" id="voice_note_data">
                            <button type="button" onclick="startRecording()" class="btn btn-secondary">تسجيل</button>
                            <button type="button" onclick="stopRecording()" class="btn btn-danger">إيقاف</button>
                            <audio id="audioPreview" controls class="mt-2" style="display: none;"></audio>
                        </div>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                @else
                    <p class="text-muted">اختر مستخدمًا لبدء المحادثة.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // تسجيل الصوت
        let mediaRecorder;
        let audioChunks = [];

        function startRecording() {
            navigator.mediaDevices.getUserMedia({
                    audio: true
                })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();

                    mediaRecorder.ondataavailable = event => {
                        audioChunks.push(event.data);
                    };

                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, {
                            type: 'audio/wav'
                        });
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            document.getElementById('voice_note_data').value = reader.result;
                            const audio = document.getElementById('audioPreview');
                            audio.src = reader.result;
                            audio.style.display = 'block';
                        };
                        reader.readAsDataURL(audioBlob);
                        audioChunks = [];
                    };
                });
        }

        function stopRecording() {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
            }
        }

        // تمرير للرسائل الجديدة تلقائياً
        const messagesBox = document.getElementById('messages-box');
        if (messagesBox) {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }
    </script>
@endsection
