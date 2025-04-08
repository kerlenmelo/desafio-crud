<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    // Proteção do controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista todos os funcionários.
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    // Formulário para criação de um funcionário.
    public function create()
    {
        return view('funcionario.create');
    }

    // Recebe e valida os dados do funcionário, após validados o novo funcionário é salvo.
    public function store(Request $request)
    {
        $funcionarioValidado = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/', 'unique:funcionarios,cpf', new Cpf()],
            'data_nascimento' => [
                'required',
                'date',
                'before:today',
            ],
            'telefone' => [
                'required',
                'regex:/^\d{10,11}$/',
            ],
            'genero' => 'required|in:Masculino,Feminino,Outro',
        ]);

        try {
            Funcionario::create($funcionarioValidado);
            return redirect()->route('funcionario.index')->with('success', 'Funcionário cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao cadastrar funcionário: ' . $e->getMessage());
        }
    }

    // Formulário para edição de um funcionário.
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario.edit', ['funcionario' => $funcionario]);
    }

    // Lista os dados de um funcionário específico.
    public function show(Funcionario $funcionario)
    {
        return view('funcionario.show', compact('funcionario'));
    }

    // Valida e atualiza os dados de um funcionário.
    public function update(Request $request, $id)
    {
        $funcionarioValidado = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => [
                'required',
                'string',
                'size:11',
                'regex:/^\d{11}$/',
                Rule::unique('funcionarios', 'cpf')->ignore($id),
                new Cpf()
            ],
            'data_nascimento' => [
                'required',
                'date',
                'before:today',
            ],
            'telefone' => [
                'required',
                'regex:/^\d{10,11}$/',
            ],
            'genero' => 'required|in:Masculino,Feminino,Outro',
        ]);
        try {
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->update($funcionarioValidado);
            return redirect()->route('funcionario.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao editar funcionário: ' . $e->getMessage());
        }
    }

    // Remove um funcionário.
    public function destroy($id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->delete();
            return redirect()->route('funcionario.index')->with('success', 'Funcionário removido com sucesso.');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao remover funcionário: ' . $e->getMessage());
        }
    }
}
