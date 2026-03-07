# Mesa Fácil — Sistema para Restaurantes e Lanchonetes

## O que é o Mesa Fácil?

Mesa Fácil é uma versão especializada do ERP baseado em Laravel, configurada para atender **restaurantes, lanchonetes, pizzarias, bares e similares**.

O sistema oferece controle de:
- Mesas e comandas
- Cardápio digital
- Pedidos (salão e delivery)
- Caixa / PDV
- Controle de cozinha (KDS)
- Financeiro básico
- Cadastro de clientes
- Relatórios de vendas

## Outros produtos derivados

O mesmo codebase suporta múltiplos nichos via a variável de ambiente `PRODUTO_TIPO`:

| Valor           | Produto              | Status     |
|-----------------|----------------------|------------|
| `mesafacil`     | Mesa Fácil (restaurantes) | ✅ Ativo |
| *(não definido)*| ERP Completo (SLYM)  | 🔒 Background |
| `mecanica`      | Oficina Fácil (futuro) | 🚧 Planejado |

---

## Tecnologias

- **Backend**: PHP / Laravel  
- **Frontend**: Blade / Metronic Theme  
- **Banco de dados**: MySQL (produção) / SQLite (desenvolvimento)  
- **Fiscal**: NFe, NFCe via sped-fiscal  

## Documentação

- [Setup inicial](mesafacil-setup.md)
- [Credenciais demo](mesafacil-credenciais-demo.md)
- [Módulos ativos / ocultos](mesafacil-modulos-ativos.md)
- [Pendências e melhorias](mesafacil-pendencias.md)
