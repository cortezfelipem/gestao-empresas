@extends('default.layout')
@section('content')

<div class="card card-custom gutter-b">

	<input type="hidden" id="pass" value="{{ $config->senha_remover ?? '' }}">

	<div class="card-body @if(getenv('ANIMACAO')) animate__animated @endif animate__backInLeft">
		<div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
			<div class="card card-custom gutter-b example example-compact">
				<div class="card-header">

					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
									<br>
									<form method="get" action="/estoque/pesquisa">
										<div class="row align-items-center">
											<div class="col-lg-5 col-xl-5">
												<div class="row align-items-center">
													<div class="col-md-12 my-2 my-md-0">
														<div class="input-group">
															<input type="text" name="pesquisa" class="form-control" placeholder="Pesquisa produto" id="kt_datatable_search_query" value="{{{ isset($pesquisa) ? $pesquisa : ''}}}">
															
														</div>
													</div>
												</div>
											</div>

											<div class="col-lg-2 col-xl-2 mt-2 mt-lg-0">
												<button class="btn btn-light-primary px-6 font-weight-bold">Pesquisa</button>
											</div>
										</div>

									</form>

									<br>
									<h4>Estoque</h4>
									@if(isset($totalProdutosEmEstoque))
									<label>Total de produtos em estoque: <strong class="text-info">{{$totalProdutosEmEstoque}}</strong></label>
									@endif

									<table class="datatable-table" style="max-width: 100%; overflow: scroll">
										<thead class="datatable-head">
											<tr class="datatable-row" style="left: 0px;">
												
												<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 200px;">Produto</span></th>
												<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">Categoria</span></th>
												<th data-field="Country" class="datatable-cell datatable-cell-sort"><span style="width: 100px;">Quanitdade</span></th>
												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">Valor de Compra</span></th>
												
												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">Valor de Venda</span></th>

												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 120px;">Subtotal Compra</span></th>
												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 120px;">Subtotal Venda</span></th>
											</tr>
										</thead>
										<tbody class="datatable-body">
											<?php 
											$subtotalCompra = 0;
											$subtotalVenda = 0;
											?>
											@foreach($estoque as $e)
											<tr class="datatable-row" style="left: 0px;">
												<td class="datatable-cell"><span class="codigo" style="width: 200px;">
													{{$e->produto->nome}} 
													{{$e->produto->grade ? " (" . $e->produto->str_grade . ")" : ""}}
												</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 80px;">{{$e->produto->categoria->nome}}</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 100px;">
													@if($e->produto->unidade_venda == 'UN' || $e->produto->unidade_venda == 'UNID')
													{{number_format($e->quantidade, 0, '.', '')}}
													@else
													{{number_format($e->quantidade, 3, '.', ',')}}
													@endif
												</span></td>
												
												<td class="datatable-cell"><span class="codigo" style="width: 80px;">
													{{ number_format($e->valor_compra, 2, ',', '.') }} {{$e->produto->unidade_compra}}
												</span></td>

												<td class="datatable-cell"><span class="codigo" style="width: 80px;">
													{{ number_format($e->produto->valor_venda, 2, ',', '.') }} {{$e->produto->unidade_venda}}
												</span></td>

												<td class="datatable-cell"><span class="codigo" style="width: 120px;">
													{{ number_format($e->valorCompra() * $e->quantidade, 2, ',', '.') }}
												</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 120px;">
													{{ number_format($e->produto->valor_venda * $e->quantidade, 2, ',', '.') }}
												</span></td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center flex-wrap">
							<div class="d-flex flex-wrap py-2 mr-3">
								@if(isset($links))
								{{$estoque->links()}}
								@endif
							</div>
						</div>

						<div class="card-body">
							<div class="row">
								<div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
									<div class="card card-custom gutter-b example example-compact">
										<div class="card-header">

											<div class="card-body">
												<h3 class="card-title">Total em estoque compra: R$ <strong style="margin-left: 3px;" class="text-danger"> {{ number_format($somaEstoque['compra'], 2, ',', '.') }}</strong></h3>

												<h3 class="card-title">Total em estoque venda: R$ <strong style="margin-left: 3px;" class="text-success"> {{ number_format($somaEstoque['venda'], 2, ',', '.') }}</strong></h3>

												<a target="_blank" class="navi-text" href="/estoque/apontamentoManual">
													<span class="label label-xl label-inline label-light-danger">Apontamento Manual</span>
												</a>

												<a target="_blank" class="navi-text" href="/estoque/listApontamentos">
													<span class="label label-xl label-inline label-light-primary">Listar Alterações</span>
												</a>

												<a onclick='swal("Atenção!", "Deseja realizar esta ação, não será possível retomar os dados?", "warning").then((sim) => {if(sim){ zerarEstoque() }else{return false} })' href="#!" class="navi-text">
													<span class="label label-xl label-inline label-light-warning">Zerar estoque completo</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('javascript')
<script type="text/javascript">
	
	function zerarEstoque(){
		let senha = $('#pass').val()
		if(senha != ""){

			swal({
				title: 'Zerar estoque',
				text: 'Informe a senha!',
				content: {
					element: "input",
					attributes: {
						placeholder: "Digite a senha",
						type: "password",
					},
				},
				button: {
					text: "Zerar!",
					closeModal: false,
					type: 'error'
				},
				confirmButtonColor: "#DD6B55",
			}).then(v => {
				if(v.length > 0){
					$.get(path+'configNF/verificaSenha', {senha: v})
					.then(
						res => {
							location.href="/estoque/zerarEstoque?senha="+v;
						},
						err => {
							swal("Erro", "Senha incorreta", "error")
							.then(() => {
								location.reload()
							});
						}
						)
				}else{
					location.reload()
				}
			})
		}else{
			swal("Erro", "Não é possível realizar esta ação sem uma senha cadastrada", 
				"error")
		}
	}
</script>
@endsection

@endsection
