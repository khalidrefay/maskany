<div class="message-detail">
    <div class="flex items-start mb-4">
        <div class="message-avatar">
            {{ substr($message->sender->first_name, 0, 1) }}{{ substr($message->sender->last_name, 0, 1) }}
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">
                    {{ $message->sender->first_name }} {{ $message->sender->last_name }}
                </h3>
                <span class="text-xs text-gray-500">
                    {{ $message->created_at->format('M j, Y h:i A') }}
                </span>
            </div>
            <div class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">
                {!! nl2br(e($message->content)) !!}
            </div>
            <div class="mt-4">
                <button onclick="loadMessages()"
                    class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to messages
                </button>
            </div>
        </div>
    </div>
</div>
