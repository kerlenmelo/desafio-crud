<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      {{ __('Cadastrar Funcionário') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form method="POST" action="{{ route('funcionario.store') }}" class="space-y-6">
          @csrf

          <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full"
              :value="old('nome')" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('nome')" />
          </div>

          <div>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full"
              :value="old('cpf')" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
          </div>

          <div>
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
            <x-text-input id="data_nascimento" name="data_nascimento" type="date" class="mt-1 block w-full"
              :value="old('data_nascimento')" />
            <x-input-error class="mt-2" :messages="$errors->get('data_nascimento')" />
          </div>

          <div>
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full"
              :value="old('telefone')" />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
          </div>

          <div>
            <x-input-label for="genero" :value="__('Gênero')" />
            <select id="genero" name="genero"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              <option value="">Selecione</option>
              <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
              <option value="Feminino" {{ old('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
              <option value="Outro" {{ old('genero') == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('genero')" />
          </div>

          <div class="flex justify-end gap-4">
            <a href="{{ route('funcionario.index') }}"
              class="inline-flex items-center px-4 py-2 bg-gray-100 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-200 transition">
              Cancelar
            </a>

            <x-primary-button>
              {{ __('Salvar') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <x-form-validator />
</x-app-layout>