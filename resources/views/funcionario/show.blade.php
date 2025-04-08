<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      {{ __('Detalhes do Funcionário') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
        <div>
          <p><strong class="text-gray-700">Nome:</strong> {{ $funcionario->nome }}</p>
          <p><strong class="text-gray-700">CPF:</strong> {{ $funcionario->cpf }}</p>
          <p><strong class="text-gray-700">Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($funcionario->data_nascimento)->format('d/m/Y') }}</p>
          <p><strong class="text-gray-700">Telefone:</strong> {{ $funcionario->telefone }}</p>
          <p><strong class="text-gray-700">Gênero:</strong> {{ $funcionario->genero }}</p>
        </div>

        <div class="flex justify-end gap-4">
          <a href="{{ route('funcionario.edit', $funcionario->id) }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
            Editar
          </a>

          <a href="{{ route('funcionario.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-200 transition">
            Voltar
          </a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>