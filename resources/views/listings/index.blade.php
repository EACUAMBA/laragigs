<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($listings) ==0)
            @foreach($listings as $listing)
                {{--                Usamos :listing='$listing' para inserirmos uma variável dentro do componente, lá devemos pegar essa variável com o @props(['listing']), deve ser o mesmo nome.--}}
                <x-listing-card :listing="$listing"/>
            @endforeach
        @else
            <p>No data</p>
        @endunless
    </div>
    <div class="mt-6 p-4">
        {{
            //Usamos o ->links('custom-navigation.blade.php') para chamarmos a paginação.
            $listings->links()
         }}
    </div>
</x-layout>
