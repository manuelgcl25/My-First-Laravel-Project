
@auth()
    <x-panel>
        <form method="POST"
              action="/posts/{{ $post->slug }}/comments"> {{--the path is just the same as this from the route Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']); --}}

            @csrf

            <header class="flex" items-center>
                <img src="https://i.pravatar.cc/60?u={{ auth()->id()}}"
                     alt=""
                     width="40"
                     height="40"
                     class="rounded-full">

                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <x-form.margindiv>
                <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none focus:ring"
                    rows="5"
                    placeholder="Quick! Think of something to say!"
                                    required></textarea>
                {{-- Above required adds browser extra validation altho we should never only rely on that type of validation // instead, we add this + validation on the server side in our PostCommentsController--}}
                {{--Next: show me the validation error for the body --}}
                <x-form.error name="body" />

            </x-form.margindiv>


            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/login" class="hover:underline">Log in</a>
        or
        <a href="/register" class="hover:underline">Register</a>
        to leave a comment.
    </p>
@endauth


