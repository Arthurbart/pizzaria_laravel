<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sabores;
use App\Models\Tamanhos;
use App\Models\Pedidos;
use Illuminate\Validation\Rule;



class pizzariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sabores = Sabores::where('status', 'Disponível')->get();
        $salgados = Sabores::where('classificacao', 'salgado')->where('status', 'Disponível')->get();
        $doces = Sabores::where('classificacao', 'doce')->where('status', 'Disponível')->get();
        $tamanhos = Tamanhos::where('status', 'Disponível')->get();

        return view ('pizzaria.index', [
            'sabores' => $sabores,
            'tamanhos' => $tamanhos,
            'salgados' => $salgados,
            'doces' => $doces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'senha' => [
                'required',
                Rule::unique('pedidos', 'senha'),
            ],
            'pizzas' => 'required',
            'preco' => 'required|numeric|min:1',
        ], [
            'senha.required' => 'Informe uma senha para acompanhar seu pedido.',
            'senha.unique'   => 'Essa senha já está sendo usada. Escolha outra.',
            'pizzas.required'=> 'O pedido não pode estar vazio.',
        ]);
        function formataCampo($id, $valor) {
            return $id . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
        }

        function calculaCRC16($dados) {
            $resultado = 0xFFFF;
            for ($i = 0; $i < strlen($dados); $i++) {
                $resultado ^= (ord($dados[$i]) << 8);
                for ($j = 0; $j < 8; $j++) {
                    if ($resultado & 0x8000) {
                        $resultado = ($resultado << 1) ^ 0x1021;
                    } else {
                        $resultado <<= 1;
                    }
                    $resultado &= 0xFFFF;
                }
            }
            return strtoupper(str_pad(dechex($resultado), 4, '0', STR_PAD_LEFT));
        }

        function geraPix($chave, $idTx = '', $valor = 0.00) {
            $resultado = "000201";
            $resultado .= formataCampo("26", "0014br.gov.bcb.pix" . formataCampo("01", $chave));
            $resultado .= "52040000"; // Código fixo
            $resultado .= "5303986";  // Moeda (Real)
            if ($valor > 0) {
                $resultado .= formataCampo("54", number_format($valor, 2, '.', ''));
            }
            $resultado .= "5802BR"; // País
            $resultado .= "5901N";  // Nome
            $resultado .= "6001C";  // Cidade
            $resultado .= formataCampo("62", formataCampo("05", $idTx ?: '***'));
            $resultado .= "6304"; 
            $resultado .= calculaCRC16($resultado); 
            return $resultado;
        }


        $chave = "03238367048";

        $valorTransacao = floatval($request['preco']);

        $idTransacao = "";

        $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

        $endereco = $request->input('bairro') . ', ' . $request->input('rua') . ', ' . $request->input('numero') . ', ' . $request->input('complemento'); 
        $cliente = $request->input('nome');
        $telefone = $request->input('telefone');
        $pedido = $request->input('pizzas');
        $preco = $request->input('preco');
        $senha = $request->input('senha');

        $confirma = Pedidos::Create([
            'fone_cliente' => $telefone,
            'nome_cliente' => $cliente,
            'locEntrega' => $endereco,
            'pedido' => $pedido,
            'preco' => $preco,
            'senha' => $senha,
            'horario' => now(),  
            'codigo_pix' => $codigoPix              
        ]);
            
        if ($confirma) {
            return redirect()
            ->route('pedido.show', $confirma->senha)
            ->with('success', 'Pedido criado com sucesso!');

        } else {
            $sabores = Sabores::where('status', 'Disponível')->get();
            $salgados = Sabores::where('classificacao', 'salgado')->where('status', 'Disponível')->get();
            $doces = Sabores::where('classificacao', 'doce')->where('status', 'Disponível')->get();
            $tamanhos = Tamanhos::where('status', 'Disponível')->get();
            echo "<script>alert('Houve um erro ao processar seu pedido. Por favor, tente novamente.');</script>";
            return view ('pizzaria.index', [
                'sabores' => $sabores,
                'tamanhos' => $tamanhos,
                'salgados' => $salgados,
                'doces' => $doces
            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $senha)
    {
        $pedido = Pedidos::where('senha', $senha)->firstOrFail();

        return view('pizzaria.pedido', compact('pedido'));
    }


    public function acompanhar(Request $request)
    {
        $request->validate([
            'senha' => 'required'
        ], [
            'senha.required' => 'Informe a senha do pedido.'
        ]);

        $pedido = Pedidos::where('senha', $request->senha)->first();

        if (!$pedido) {
            return back()->withErrors([
                'senha' => 'Pedido não encontrado para essa senha.'
            ]);
        }

        return redirect()->route('pedido.show', $pedido->senha);
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
    public function destroy(string $senha)
    {
        Pedidos::where('senha', $senha)->delete();

        return redirect()
            ->route('pizzaria.index')
            ->with('success', 'Pedido cancelado com sucesso!');

    }
    

}
