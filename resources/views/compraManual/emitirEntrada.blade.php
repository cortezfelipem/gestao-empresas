
@extends('default.layout')
@section('content')

<div class="card card-custom gutter-b">
	<div class="col-xl-12">
		
		<div class="card-body">
			<div class="row">
				
				<div class="col-sm-12 col-lg-12 col-md-6 col-xl-6">

					<h4>Código: <strong>{{$compra->id}}</strong></h4>
					<h4>Nº NF-e Importada: <strong>{{$compra->nf > 0 ? $compra->nf : '*'}}</strong></h4>
					<h4>Nº NF-e Emitida: <strong>{{$compra->numero_emissao > 0 ? $compra->numero_emissao : '*'}}</strong></h4>


					<h5>Usuário: <strong>{{$compra->usuario->nome}}</strong></h5>
					
				</div>

				<div class="col-sm-12 col-lg-12 col-md-6 col-xl-6">

					<h5>Fornecedor: <strong>{{$compra->fornecedor->razao_social}}</strong></h5>
					<h5>Data: <strong>{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y H:i:s')}}</strong></h5>

					@if($compra->numero_emissao > 0)
					<h5>Data de Emissão: <strong>{{ \Carbon\Carbon::parse($compra->updated_at)->format('d/m/Y H:i:s')}}</strong></h5>
					<h5>Chave: <strong>
						{{$compra->chave ?? '--'}}
					</strong></h5>

					@endif

					<h5>Estado: 
						@if($compra->estado == 'NOVO')
						<span class="label label-xl label-inline label-light-primary">Disponível</span>

						@elseif($compra->estado == 'APROVADO')
						<span class="label label-xl label-inline label-light-success">Aprovado</span>
						@elseif($compra->estado == 'CANCELADO')
						<span class="label label-xl label-inline label-light-danger">Cancelado</span>
						@else
						<span class="label label-xl label-inline label-light-warning">Rejeitado</span>
						@endif
					</h5>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" id="_token" value="{{csrf_token()}}">


	<div class="card-body">

		<div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
			<div class="card card-custom gutter-b example example-compact">
				<div class="card-header">

					<div class="col-xl-12">
						<div class="row">

							<div class="col-xl-12">

								<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
									<br>
									<h4>Itens da Compra</h4>

									<table class="datatable-table" style="max-width: 100%; overflow: scroll">
										<thead class="datatable-head">
											<tr class="datatable-row" style="left: 0px;">
												<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">#</span></th>
												<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 150px;">Produto</span></th>
												<th data-field="Country" class="datatable-cell datatable-cell-sort"><span style="width: 100px;">Valor</span></th>
												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">Quantidade</span></th>

												<th data-field="ShipDate" class="datatable-cell datatable-cell-sort"><span style="width: 80px;">Subtotal</span></th>

											</tr>
										</thead>
										<tbody class="datatable-body">
											@php 
											$p = null;
											@endphp
											@foreach($compra->itens as $i)
											@php 
											$p = $i;
											@endphp
											<tr class="datatable-row" style="left: 0px;">
												<td class="datatable-cell"><span class="codigo" style="width: 80px;">{{$i->produto_id}}</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 150px;">{{$i->produto->nome}}</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 100px;">{{number_format($i->valor_unitario, 2, ',', '.')}}</span></td>

												<td class="datatable-cell"><span class="codigo" style="width: 80px;">{{$i->quantidade}}</span></td>
												<td class="datatable-cell"><span class="codigo" style="width: 80px;">{{number_format(($i->valor_unitario * $i->quantidade), 2, ',', '.')}}</span></td>


											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-12 col-md-12 col-xl-6">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">

									<div class="card-body">
										<h4>Fatura</h4>
										<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
											<table class="datatable-table" style="max-width: 100%; overflow: scroll">
												<thead class="datatable-head">
													<tr class="datatable-row" style="left: 0px;">
														<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 100px;">Vencimento</span></th>
														<th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 100px;">Valor</span></th>

													</tr>
												</thead>


												@if(sizeof($compra->fatura) > 0)
												<tbody class="datatable-body">
													@foreach($compra->fatura as $f)
													<tr class="datatable-row" style="left: 0px;">
														<td class="datatable-cell"><span class="codigo" style="width: 100px;">{{ \Carbon\Carbon::parse($f->data_vencimento)->format('d/m/Y')}}
														</span></td>
														<td class="datatable-cell"><span class="codigo" style="width: 100px;">
															{{number_format(($f->valor_integral), 2, ',', '.')}}
														</span></td>

													</tr>
													@endforeach
												</tbody>
												@else
												<tbody class="datatable-body">
													<tr class="datatable-row" style="left: 0px;">
														<td class="datatable-cell"><span class="codigo" style="width: 80px;">
															{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y')}}
														</span></td>
														<td class="datatable-cell"><span class="codigo" style="width: 80px;">
															{{number_format(($compra->valor), 2, ',', '.')}}
														</span></td>

													</tr>
												</tbody>
												@endif


											</table>
										</div>



									</div>



								</div>
							</div>
						</div>

						<div class="col-sm-12 col-lg-12 col-md-12 col-xl-6">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">

									<div class="card-body">

										<div class="form-group validated">
											<label class="col-form-label text-left">Natureza de Operação</label>

											<select class="custom-select form-control" id="natureza" name="natureza">
												@foreach($naturezas as $n)
												<option value="{{$n->id}}">{{$n->natureza}} - {{$n->CFOP_entrada_estadual}}/{{$n->CFOP_entrada_inter_estadual}}</option>
												@endforeach
											</select>

										</div>

										<div class="form-group validated">
											<label class="col-form-label text-left">Tipo de Pagamento</label>

											<select class="custom-select form-control" id="tipo_pagamento" name="tipo_pagamento">
												@foreach($tiposPagamento as $key => $t)

												<option value="{{$key}}">{{$key}} - {{$t}}</option>
												@endforeach
											</select>

										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-12">

							<div class="card card-custom gutter-b example example-compact">

								<div class="card-body">
									@if($compra->estado == 'NOVO')
									<div class="row">
										<div class="col-12">
											<button data-toggle="modal" data-target="#modal-referencia-nfe" @if(sizeof($compra->chaves) == 0) class="btn btn-light" @else class="btn btn-info" @endif>
												<i class="la la-list"></i>
												Referênciar NF-e
											</button>
										</div>
									</div>
									@endif
									<br>
									<h3 class="card-title">Total: R$ <strong class="red-text">{{number_format($compra->valor, 2, ',', '.')}}</strong></h3>


									<h5>Oservação: 
										<strong>
											{{$compra->observacao}}

											@php
											$veiCpl = '';


											if($p->produto->renavam != ''){
											$veiCpl = 'RENAVAM ' . $p->produto->renavam;
											if($p->produto->placa != '') $veiCpl .= ', PLACA ' . $p->produto->placa;
											if($p->produto->chassi != '') $veiCpl .= ', CHASSI ' . $p->produto->chassi;
											if($p->produto->combustivel != '') $veiCpl .= ', COMBUSTÍVEL ' . $p->produto->combustivel;
											if($p->produto->ano_modelo != '') $veiCpl .= ', ANO/MODELO ' . $p->produto->ano_modelo;
											if($p->produto->cor_veiculo != '') $veiCpl .= ', COR ' . $p->produto->cor_veiculo;

										}
										@endphp

										{{$veiCpl}}
									</strong>
								</h5>

								@if($compra->chave != '')

								@if($compra->estado != 'CANCELADO')


								<a target="_blank" class="btn btn-light-success" href="/compras/imprimir/{{$compra->id}}">
									Imprimir
								</a>

								<a target="_blank" class="btn btn-light-dark" href="/compras/downloadXml/{{$compra->id}}">
									Downlaod XML
								</a>

								<a href="#!" class="btn btn-light-danger" data-toggle="modal" data-target="#modal-cancelar">
									Cancelar
								</a>

								<a id="btn-consulta" href="#!" class="spinner-white spinner-right btn btn-light-info">
									Consultar
								</a>

								<a data-toggle="modal" data-target="#modal4" class="btn btn-light-warning">
									Carta de correção
								</a>

								@else

								<a target="_blank"  class="btn btn-light-danger" href="/compras/downloadXmlCancela/{{$compra->id}}">
									Downlaod XML Cancelamento
								</a>

								<a id="btn-consulta" href="#!" class="spinner-white spinner-right btn btn-light-info">
									Consultar
								</a>

								@endif

								@else


								<a onclick="xmlTemporaria({{$compra->id}})" type="button" class="btn btn-warning">
									Xml Temporário
								</a>

								<a onclick="danfeTemporaria({{$compra->id}})" type="button" class="btn btn-info">
									Danfe Temporária
								</a>

								<a onclick="enviar({{$compra->id}})" type="button" id="btn-enviar-nfe" class="btn btn-success spinner-white spinner-right">
									Transmitir para Sefaz
								</a>

								@endif

							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>



</div>

<div class="modal fade" id="modal-cancelar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cancelar NF-e de Entrada</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					x
				</button>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="form-group validated col-sm-12 col-lg-12">
						<label class="col-form-label">Justificativa</label>
						<div class="">
							<input id="justificativa" placeholder="Informe no minimo 15 caracteres" type="text" class="form-control" name="justificativa" value="">
						</div>
					</div>
				</div>

				<input type="hidden" value="{{$compra->id}}" id="compra_id" name="">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Fechar</button>
				<button type="button" id="btn-cancelar" onclick="cancelar()" class="btn btn-danger font-weight-bold spinner-white spinner-right">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal4" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">CARTA DE CORREÇÃO NF-e ENTRADA<strong class="text-danger" style="margin-left: 3px;">{{$compra->numero_emissao}}</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					x
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group validated col-sm-12 col-lg-12">
						<label class="col-form-label" id="">Correção</label>
						<div class="">
							<input type="text" id="correcao" placeholder="Correção minimo de 15 caracteres" name="correcao" class="form-control" value="">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Fechar</button>
				<button type="button" id="btn-corrigir-2" onclick="cartaCorrecao()" class="btn btn-light-success font-weight-bold spinner-white spinner-right">Corrigir NFe</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-referencia-nfe" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Referência NF-e</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					x
				</button>
			</div>
			<div class="modal-body">
				<form class="row" method="post" action="/compras/salvarChaveRef">
					@csrf
					<input type="hidden" value="{{$compra->id}}" name="compra_id">
					<div class="form-group validated col-12 col-lg-10">
						<div class="">
							<input required="" minlength="44" name="chave" placeholder="Chave" type="text" id="chave" class="form-control">
						</div>
					</div>

					<div class="form-group validated col-12 col-lg-2">
						<button type="submit" class="btn btn-success">
							<i class="la la-plus"></i>
						</button>
					</div>
				</form>

				<div class="row">
					<div class="col-12">

						<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
							<table class="datatable-table" id="chaves">
								<thead class="datatable-head">
									<tr class="datatable-row">
										<th class="datatable-cell datatable-cell-sort">
											Chaves adcionadas
										</th>
									</tr>
								</thead>
								<tbody class="datatable-body" id="chaves">
									@foreach($compra->chaves as $ch)
									<tr style="margin-top: 10px;">
										<td style="font-weight: bold; font-size: 17px; margin-right: 20px;">{{$ch->chave}}</td>
										<td>
											<a style="margin-left: 20px;" href="/compras/deleteChave/{{$ch->id}}" class="btn btn-small btn-danger">
												<i class="la la-trash"></i>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

@endsection



