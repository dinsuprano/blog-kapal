<x-blog-layout>
    <section class="pb-16">
        <div class="container mx-auto">
            <div class="mb-10 flex gap-x-2 text-sm font-semibold">
                <a href="{{ route('filamentblog.post.index') }}" class="opacity-60">Home</a>
                <span class="opacity-30">/</span>
                <a href="{{ route('filamentblog.post.all') }}" class="opacity-60">Blog</a>
                <span class="opacity-30">/</span>
                <a title="{{ $post->slug }}" href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}" class="hover:text-primary-600 max-w-2xl truncate font-medium transition-all duration-300">
                    {{ $post->title }}
                </a>
            </div>
            <div class="mx-auto mb-20 space-y-10">
                <div class="grid gap-x-20 sm:grid-cols-[minmax(min-content,10%)_1fr_minmax(min-content,10%)]">
                    <div class="py-5">
                        <div class="sticky top-24 flex flex-col items-center gap-y-5 divide-y-2">
                            {{-- <button x-data="" x-on:click="document.getElementById('comments').scrollIntoView({ behavior: 'smooth'})" class="group/btn flex flex-col items-center justify-center gap-y-2">
                                <div class="flex items-center justify-center rounded-full bg-slate-100 px-4 py-4 group-hover/btn:bg-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13 11H7a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2m4-4H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2m2-5H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h11.59l3.7 3.71A1 1 0 0 0 21 22a.84.84 0 0 0 .38-.08A1 1 0 0 0 22 21V5a3 3 0 0 0-3-3m1 16.59l-2.29-2.3A1 1 0 0 0 17 16H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold">COMMENTS</span>
                            </button> --}}
                            <div class="pt-5">
                                {!! $shareButton?->html_code !!}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-10">
                        <div>
                            <div class="flex flex-col justify-end">

                                <div class="mb-6">
                                    <!-- Post Title -->
                                    <h1 class="mb-2 text-4xl font-semibold">
                                        {{ $post->title }}
                                    </h1>

                                    <!-- Author + Date -->
                                    <div class="text-sm text-gray-500">
                                        {{ $post->user->name() }} / {{ $post->formattedPublishedDate() }}
                                    </div>
                                </div>

                                <div class="mb-6 h-full w-full overflow-hidden rounded bg-slate-200">
                                    <img class="flex h-full min-h-[400px] items-center justify-center object-cover object-top text-sm text-xl font-semibold text-slate-400" src="{{ $post->featurePhoto  }}" alt="{{ $post->photo_alt_text }}">
                                </div>

                                <div>
                                    <article class="m-auto leading-6">

                                        {!! tiptap_converter()->asHTML($post->body, toc: true, maxDepth: 3) !!}
                                    </article>

                                   
                                    <div class="pt-10">
                                        <span class="mb-3 block font-semibold">Tags</span>
                                        <div class="space-x-2 space-y-1">

                                            @if($post->tags->count())
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('filamentblog.tag.post', ['tag' => $tag->slug]) }}" class="rounded-full border border-slate-300 px-3 py-1 text-sm font-mediumtext-slate-600 hover:bg-slate-100">
                                                        {{ $tag->name }}
                                                    </a>
                                                @endforeach
                                            @endif
                                            
                                            @foreach ($post->categories as $category)
                                                <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}">
                                                    <span class="rounded-full border border-slate-300 px-3 py-1 text-sm font-medium text-slate-600 hover:bg-slate-100">{{ $category->name }}
                                                    </span>
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                           
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

                                    @php
                                        $url = urlencode(route('filamentblog.post.show', $post->slug));
                                        $title = urlencode($post->title);
                                    @endphp
                                    {{-- Share Links --}}                           
                                    <div class="pt-10">
                                        <span class="mb-3 block font-semibold">Share this link</span>
                                        <div class="space-x-4 space-y-2 text-xl">
                                            {{-- Facebook --}}
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" aria-label="Share on Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>

                                            {{-- LinkedIn --}}
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}" target="_blank" aria-label="Share on LinkedIn">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>

                                            {{-- Copy link --}}
                                            <a href="#" onclick="navigator.clipboard.writeText('{{ route('filamentblog.post.show', $post->slug) }}'); alert('Link copied!')" aria-label="Copy Link">
                                                <i class="fa-solid fa-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="border-t-2 py-10">
                            <div class="mb-4">
                                <h3 class="mb-2 text-2xl font-semibold">Author</h3>
                            </div>

                            <div class="flex flex-col gap-y-6">
                                <article class="pt-4 text-base">
                                    <!-- Top Row: Avatar + Name -->
                                    <div class="flex items-center gap-4 mb-3">
                                        <img class="h-14 w-14 rounded-full border-4 border-white bg-zinc-300 object-cover ring-1 ring-slate-300" 
                                                src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}" alt="avatar">
                                        <span class="font-semibold text-lg" title="{{ $post->user->name() }}" >{{ $post->user->name() }}</span>
                                        
                                        @if($post->user->url_link)
                                            <a class="text-xl text-blue-600 hover:text-blue-800" 
                                            href="{{ $post->user->url_link }}" 
                                            target="_blank" 
                                            rel="noopener noreferrer"
                                            aria-label="Share on LinkedIn">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Description Below -->
                                    <p class="text-gray-500 text-sm leading-relaxed">
                                        {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. --}}
                                        {{ $post->user->description ?? 'No description available.' }}
                                    </p>
                                </article>
                            </div>
                        </div>


                        {{-- <x-blog-comment :post="$post" /> --}}
                    </div>
                    <div>
                        {{-- Ads Section --}}
                         {{-- <div class="sticky top-24 flex h-[600px] w-[160px] items-center justify-center overflow-hidden rounded bg-slate-200 font-medium text-slate-500/20">
                            <span>ADS</span>
                         </div> --}}
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <div class="relative mb-6 flex items-center gap-x-8">
                        <h2 class="whitespace-nowrap text-xl font-semibold">
                            <span class="text-primary font-bold">#</span> Related Posts
                        </h2>
                        <div class="flex w-full items-center">
                            <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-x-12 gap-y-10">
                        @forelse($post->relatedPosts() as $post)
                        <x-blog-card :post="$post" />
                        @empty
                        <div class="col-span-3">
                            <p class="text-center text-xl font-semibold text-gray-300">No related posts found.</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="flex justify-center pt-20">
                        <a href="{{ route('filamentblog.post.all') }}" class="flex items-center justify-center md:gap-x-5 rounded-full bg-slate-100 px-20 py-4 text-sm font-semibold transition-all duration-300 hover:bg-slate-200">
                            <span>Show all blogs</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6m0 0H9m9 0v9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $shareButton?->script_code !!}
</x-blog-layout>
