<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erros do Sistema — {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #0f1117; color: #e2e8f0; min-height: 100vh; padding: 24px; }
        header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
        h1 { font-size: 1.4rem; color: #f87171; display: flex; align-items: center; gap: 8px; }
        .badge { background: #ef4444; color: #fff; border-radius: 999px; padding: 2px 10px; font-size: .8rem; }
        .badge-zero { background: #22c55e; }
        .toolbar { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        input[type=text] { background: #1e2130; border: 1px solid #334155; color: #e2e8f0; padding: 8px 14px; border-radius: 6px; font-size: .9rem; width: 260px; }
        input[type=text]::placeholder { color: #64748b; }
        .btn { padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer; font-size: .85rem; text-decoration: none; display: inline-block; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-secondary { background: #334155; color: #cbd5e1; }
        .btn:hover { opacity: .85; }
        .back { color: #60a5fa; text-decoration: none; font-size: .9rem; }
        .back:hover { text-decoration: underline; }
        .msg { background: #166534; color: #bbf7d0; padding: 10px 16px; border-radius: 6px; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: .82rem; }
        thead th { background: #1e2130; color: #94a3b8; padding: 10px 12px; text-align: left; border-bottom: 1px solid #2d3748; position: sticky; top: 0; }
        tbody tr { border-bottom: 1px solid #1e2130; }
        tbody tr:hover { background: #1a1f2e; }
        td { padding: 9px 12px; vertical-align: top; max-width: 320px; word-break: break-word; }
        .tipo { color: #f97316; font-size: .75rem; }
        .ts { color: #64748b; white-space: nowrap; }
        .url { color: #60a5fa; font-size: .78rem; }
        .loc { color: #a78bfa; font-size: .75rem; }
        .usr { color: #34d399; font-size: .78rem; }
        .empty { text-align: center; padding: 60px; color: #475569; }
        .empty span { font-size: 3rem; display: block; margin-bottom: 12px; }
        .count-info { color: #64748b; font-size: .82rem; }
    </style>
</head>
<body>

<header>
    <h1>
        🔴 Erros do Sistema
        <span class="badge {{ $total == 0 ? 'badge-zero' : '' }}">{{ $total }}</span>
    </h1>
    <div class="toolbar">
        <a href="/graficos" class="back">← Voltar ao sistema</a>
        <form method="GET" action="/erros" style="display:flex;gap:8px">
            <input type="text" name="busca" placeholder="Filtrar por mensagem, URL, tipo..." value="{{ $busca }}">
            <button type="submit" class="btn btn-secondary">Filtrar</button>
        </form>
        <form method="POST" action="/erros/limpar" onsubmit="return confirm('Limpar todos os erros?')">
            @csrf
            <button type="submit" class="btn btn-danger">🗑 Limpar log</button>
        </form>
    </div>
</header>

@if(session('msg'))
    <div class="msg">{{ session('msg') }}</div>
@endif

@if($total == 0)
    <div class="empty">
        <span>✅</span>
        Nenhum erro registrado no sistema.
    </div>
@else
    <p class="count-info" style="margin-bottom:12px">
        Exibindo {{ count($erros) }} de {{ $total }} erros (mais recentes primeiro)
    </p>
    <table>
        <thead>
            <tr>
                <th style="width:130px">Data/Hora</th>
                <th>Mensagem</th>
                <th>Tipo</th>
                <th>Arquivo:Linha</th>
                <th>URL</th>
                <th>Usuário</th>
            </tr>
        </thead>
        <tbody>
            @foreach($erros as $e)
            <tr>
                <td class="ts">{{ $e['timestamp'] ?? '-' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($e['mensagem'] ?? '-', 120) }}</td>
                <td class="tipo">{{ class_basename($e['tipo'] ?? '-') }}</td>
                <td class="loc">{{ $e['arquivo'] ?? '-' }}<br>linha {{ $e['linha'] ?? '-' }}</td>
                <td class="url">
                    <span title="{{ $e['url'] ?? '' }}">{{ \Illuminate\Support\Str::limit($e['url'] ?? '-', 60) }}</span>
                    @if(!empty($e['method']))<br><span style="color:#94a3b8">{{ $e['method'] }}</span>@endif
                </td>
                <td class="usr">
                    {{ $e['usuario'] ?? 'não logado' }}
                    @if(!empty($e['empresa_id']))<br><span style="color:#64748b">emp #{{ $e['empresa_id'] }}</span>@endif
                    @if(!empty($e['ip']))<br><span style="color:#475569">{{ $e['ip'] }}</span>@endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
