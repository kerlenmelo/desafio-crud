<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Masmerise\Toaster\Toaster;

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
        $funcionarioValidado = $funcionarioValidado = $this->validateFuncionario($request);
        try {
            Funcionario::create($funcionarioValidado);
            Toaster::success('Funcionário cadastrado com sucesso!');
            return redirect()->route('funcionario.index');
        } catch (\Exception $e) {
            Toaster::error('Erro ao cadastrar funcionário: ' . $e->getMessage());
            return back();
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
        $funcionarioValidado = $this->validateFuncionario($request, $id);
        try {
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->update($funcionarioValidado);
            Toaster::success('Funcionário editado com sucesso!');
            return redirect()->route('funcionario.index');
        } catch (\Exception $e) {
            Toaster::error('Erro ao cadastrar funcionário: ' . $e->getMessage());
            return back();
        }
    }

    // Remove um funcionário.
    public function destroy($id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->delete();
            Toaster::success('Funcionário removido com sucesso!');
            return redirect()->route('funcionario.index');
        } catch (\Exception $e) {
            Toaster::error('Erro ao cadastrar funcionário: ' . $e->getMessage());
            return back();
        }
    }

    // Função para validar o cadastro e a edição de funcionários
    private function validateFuncionario(Request $request, $id = null)
    {
        return $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => [
                'required',
                'string',
                'size:11',
                'regex:/^\d{11}$/',
                Rule::unique('funcionarios', 'cpf')->ignore($id),
                new Cpf()
            ],
            'data_nascimento' => 'nullable|date',
            'telefone' => 'nullable|regex:/^\d{10,11}$/',
            'genero' => 'required|in:Masculino,Feminino,Outro',
        ]);
    }
}
