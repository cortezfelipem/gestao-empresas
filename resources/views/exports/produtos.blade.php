<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>COR</th>
            <th>CATEGORIA</th>
            <th>VALOR DE COMPRA</th>
            <th>VALOR DE VENDA</th>

            <th>NCM</th>
            <th>CÓDIGO DE BARRAS</th>
            <th>CEST</th>
            <th>CST/CSOSN</th>
            <th>CST PIS</th>
            <th>CST COFINS</th>
            <th>CST IPI</th>

            <th>UN. COMPRA</th>
            <th>UN. VENDA</th>

            <th>PERCENTUAL ICMS</th>
            <th>PERCENTUAL PIS</th>
            <th>PERCENTUAL COFINS</th>
            <th>PERCENTUAL IPI</th>
            <th>CFOP SAIDA ESTADUAL</th>
            <th>CFOP SAIDA OUTRO ESTADO</th>
            <th>CÓDIGO ANP</th>
            <th>REFERÊNCIA</th>
            <th>LARGURA</th>
            <th>COMPRIMENTO</th>
            <th>ALTURA</th>
            <th>PESO LIQUIDO</th>
            <th>PESO BRUTO</th>

            <th>ESTOQUE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
        <tr>
            <td>{{$p->nome}} {{$p->str_grade}}</td>
            <td>{{$p->cor}}</td>
            <td>{{$p->categoria->nome}}</td>

            <td>R$ {{number_format($p->valor_venda, 2, ',', '.')}}</td>
            <td>R$ {{number_format($p->valor_compra, 2, ',', '.')}}</td>

            <td>{{$p->ncm}}</td>
            <td>{{$p->codBarras}}</td>
            <td>{{$p->CEST}}</td>

            <td>{{$p->CST_CSOSN}}</td>
            <td>{{$p->CST_PIS}}</td>
            <td>{{$p->CST_COFINS}}</td>
            <td>{{$p->CST_IPI}}</td>

            <td>{{$p->unidade_compra}}</td>
            <td>{{$p->unidade_venda}}</td>

            <td>{{$p->perc_icms}}</td>
            <td>{{$p->perc_pis}}</td>
            <td>{{$p->perc_cofins}}</td>
            <td>{{$p->perc_ipi}}</td>

            <td>{{$p->CFOP_saida_estadual}}</td>
            <td>{{$p->CFOP_saida_inter_estadual}}</td>
            <td>{{$p->codigo_anp}}</td>
            <td>{{$p->referencia}}</td>
            <td>{{$p->largura}}</td>
            <td>{{$p->comprimento}}</td>
            <td>{{$p->altura}}</td>
            <td>{{$p->peso_liquido}}</td>
            <td>{{$p->peso_bruto}}</td>


            <td>{{$p->estoqueAtual()}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
