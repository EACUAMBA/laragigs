{{--Usamos a variavel attributes para pegar oos atributos passados no chamamento do componente e fazermos o merge com os atributos que já estão aqui!--}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}} >
{{--    Usamos o slot para pegar os elementos children deste componente. <x-card>children</x-card>--}}
    {{$slot}}
</div>
