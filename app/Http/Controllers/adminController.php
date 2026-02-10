<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sabores;
use App\Models\Tamanhos;
use App\Models\Pedidos;

use function Laravel\Prompts\alert;

class adminController extends Controller
{
    private string $senhaAdmin = 'peppino';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'senha' => 'required'
        ]);

        if ($request->senha !== $this->senhaAdmin) {
            return back()->withErrors([
                'senha' => 'Senha incorreta'
            ]);
        }

        session(['admin' => true]);

        return redirect()->route('admin.show');
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storeSabores(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'ingredientes' => 'required',
            'classificacao' => 'required',
            'preco' => 'required|numeric'
        ]);

        $tentativa = Sabores::create($request->only('nome', 'ingredientes', 'classificacao', 'preco'));
        if (!$tentativa) {
            return redirect()->route('admin.show')->withErrors([
                'erro' => 'Ocorreu um erro ao adicionar o sabor. Tente novamente.'
            ]);
        }
        return redirect()->route('admin.show')->with('success', 'Sabor adicionado com sucesso!');
    }

    public function storeTamanhos(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'qpedacos' => 'required|integer',
            'qsabores' => 'required|integer',
            'preco' => 'required|numeric'
        ]);

        $tentativa = Tamanhos::create($request->only('nome', 'qpedacos', 'qsabores', 'preco'));
        if (!$tentativa) {
            return redirect()->route('admin.show')->withErrors([
                'erro' => 'Ocorreu um erro ao adicionar o tamanho. Tente novamente.'
            ]);
        }

        return redirect()->route('admin.show')->with('success', 'Tamanho adicionado com sucesso!');
    }

    public function updateSabores(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'ingredientes' => 'required',
            'classificacao' => 'required',
            'status' => 'required',
            'preco' => 'required|numeric'
        ]);

        $sabor = Sabores::findOrFail($id);
        $sabor->update($request->only('nome', 'ingredientes', 'classificacao', 'status', 'preco'));

        return redirect()->route('admin.show')->with('success', 'Sabor atualizado com sucesso!');
    }

    public function updateTamanhos(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'qpedacos' => 'required|integer',
            'qsabores' => 'required|integer',
            'status' => 'required',
            'preco' => 'required|numeric'
        ]);

        $tamanho = Tamanhos::findOrFail($id);
        $tamanho->update($request->only('nome', 'qpedacos', 'qsabores', 'status', 'preco'));

        return redirect()->route('admin.show')->with('success', 'Tamanho atualizado com sucesso!');
    }

    public function destroySabores($id)
    {
        try {
            $sabor = Sabores::findOrFail($id);
            $sabor->delete();

            return redirect()->back()->with('success', 'Sabor removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover o sabor. Tente novamente.');
        }
    }

    public function destroyTamanhos($id)
    {
        try {
            $tamanho = Tamanhos::findOrFail($id);
            $tamanho->delete();

            return redirect()->back()->with('success', 'Tamanho removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover o tamanho. Tente novamente.');
        }
    }

    public function updatePedidos(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pedido = Pedidos::findOrFail($id);
        $pedido->update($request->only('status'));

        return redirect()->route('admin.show')->with('success', 'Pedido atualizado com sucesso!');
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (!session('admin')) {
            return redirect()->route('admin.index');
        }

        $sabores = Sabores::all();
        $tamanhos = Tamanhos::all();
        $pedidos = Pedidos::all();

        return view('admin.show', compact('sabores', 'tamanhos', 'pedidos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
