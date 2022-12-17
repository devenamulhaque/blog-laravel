@extends('components.layout');

@section('body')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <article
            class="rounded-xl">
            <div class="py-6 px-5 lg:flex">
                <div class="flex-1 flex flex-col">
                    <h1>{{$post->title}}</h1>
                    <div class="prose">
                        <?= $post->body; ?>
                    </div>
                </div>
            </div>
        </article>

    </main>
@endsection
