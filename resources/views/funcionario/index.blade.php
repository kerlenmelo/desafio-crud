<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      {{ __('Lista de Funcionários') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-visible shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-lg font-medium text-gray-900">Funcionários</h3>
          <a href="{{ route('funcionario.create') }}">
            <x-primary-button>+ Adicionar Funcionário</x-primary-button>
          </a>
        </div>

        @if ($funcionarios->isEmpty())
        <p class="text-gray-500">Nenhum funcionário cadastrado.</p>
        @else
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 text-gray-600">Nome</th>
                <th class="px-4 py-2 text-gray-600">CPF</th>
                <th class="px-4 py-2 text-gray-600">Data de Nascimento</th>
                <th class="px-4 py-2 text-gray-600">Telefone</th>
                <th class="px-4 py-2 text-gray-600">Gênero</th>
                <th class="px-4 py-2 text-gray-600">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($funcionarios as $funcionario)
              <tr>
                <td class="px-4 py-2">{{ $funcionario->nome }}</td>
                <td class="px-4 py-2">{{ $funcionario->cpf }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($funcionario->data_nascimento)->format('d/m/Y') }}</td>
                <td class="px-4 py-2">{{ $funcionario->telefone }}</td>
                <td class="px-4 py-2">{{ $funcionario->genero }}</td>
                <td class="text-sm text-gray-700">
                  <div class="relative inline-block text-left">
                    <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                        <button type="button"
                          class="inline-flex items-center px-2 py-1 bg-gray-100 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-200 transition">
                          Ações
                          <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8l5 5 5-5" />
                          </svg>
                        </button>
                      </x-slot>

                      <x-slot name="content">
                        <x-dropdown-link :href="route('funcionario.show', $funcionario->id)">
                          {{ __('Ver') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('funcionario.edit', $funcionario->id)">
                          {{ __('Editar') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#" class="text-red-600 hover:bg-gray-100" x-on:click.prevent="$dispatch('open-modal', 'confirm-funcionario-deletion-{{ $funcionario->id }}')">
                          {{ __('Excluir') }}
                        </x-dropdown-link>
                      </x-slot>
                    </x-dropdown>
                  </div>
                </td>
              </tr>
              <x-modal name="confirm-funcionario-deletion-{{ $funcionario->id }}" :show="false" focusable>
                <form method="POST" action="{{ route('funcionario.destroy', $funcionario->id) }}" class="p-6">
                  @csrf
                  @method('DELETE')
                  <h2 class="text-lg font-medium text-gray-900 p-2">
                    {{ __('Tem certeza de que deseja excluir este funcionário?') }}
                  </h2>
                  <div class="mb-4 flex justify-end gap-2 p-2">
                    <x-secondary-button x-on:click="$dispatch('close')" class="me-3">
                      {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-danger-button class="ms-3">
                      {{ __('Excluir') }}
                    </x-danger-button>
                  </div>
                </form>
              </x-modal>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>