@props(['node', 'level' => 0])

<div class="flex flex-col items-center">
    @if($level > 0)
        <div class="w-px h-6" style="background-color:#d1a3ac"></div>
    @endif

    @if($node->photo)
        <div class="bg-white rounded-2xl shadow-lg px-5 py-4 text-center min-w-[200px] z-10 border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl cursor-default">
            <img src="{{ asset('storage/'.$node->photo) }}"
                 alt="{{ $node->name }}"
                 class="w-20 h-20 rounded-full mx-auto mb-2 object-cover bg-gray-200">
            @if($node->name)
                <p class="font-bold text-gray-900 text-sm">{{ $node->name }}</p>
            @endif
            <p class="text-maroon text-xs font-semibold mt-0.5">{{ $node->position }}</p>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg px-5 py-4 text-center min-w-[150px] z-10 border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl cursor-default">
            @if($node->name)
                <p class="font-bold text-white text-sm">{{ $node->name }}</p>
            @endif
            <p class="text-maroon text-xs font-bold mt-0.5">{{ $node->position }}</p>
        </div>
    @endif

    @if($node->children->isNotEmpty())
        <div class="w-px h-6" style="background-color:#d1a3ac"></div>

        <div class="flex items-start">
            @foreach($node->children as $i => $child)
                <div class="flex flex-col items-center px-4 relative">
                    @if($node->children->count() > 1)
                        <div class="absolute top-0 h-px"
                             style="
                                background-color:#d1a3ac;
                                left: {{ $i === 0 ? '50%' : '0' }};
                                right: {{ $i === $node->children->count() - 1 ? '50%' : '0' }};
                             ">
                        </div>
                    @endif
                    <x-org-node :node="$child" :level="$level + 1" />
                </div>
            @endforeach
        </div>
    @endif
</div>