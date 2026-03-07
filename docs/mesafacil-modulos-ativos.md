# Mesa Fácil — Módulos Ativos e Ocultos

O controle de módulos é feito via variáveis de ambiente no `.env` **e** pela variável `PRODUTO_TIPO=mesafacil` que seleciona o menu específico do produto.

## Módulos ATIVOS no Mesa Fácil

| Módulo                  | Env var         | Rota(s) principal(is)              |
|-------------------------|-----------------|------------------------------------|
| Salão / Mesas           | *(sempre ativo)*| `/mesas`                           |
| Controle de Cozinha     | *(sempre ativo)*| `/controleCozinha/selecionar`      |
| Cardápio / Produtos     | *(sempre ativo)*| `/produtos`, `/categorias`         |
| Delivery                | `DELIVERY=1`    | `/deliveryConfig`, `/pedidoDelivery` |
| Caixa / PDV             | *(sempre ativo)*| `/caixa`, `/pdv`                   |
| Contas a Pagar/Receber  | *(sempre ativo)*| `/contasReceber`, `/contasPagar`   |
| Clientes                | *(sempre ativo)*| `/clientes`                        |
| Formas de Pagamento     | *(sempre ativo)*| `/formasPagamento`                 |
| Relatórios              | *(sempre ativo)*| `/relatorios/*`                    |
| Configurações           | *(sempre ativo)*| `/empresa`, `/configNF`            |

---

## Módulos OCULTOS (disponíveis no ERP completo)

> Desativados via `.env` e não aparecem no menu `PRODUTO_TIPO=mesafacil`.

| Módulo                  | Env var          | Para reativar              |
|-------------------------|------------------|----------------------------|
| CT-e (Conhecimento Transporte) | `CTE=0` | Setar `CTE=1` e limpar `PRODUTO_TIPO` |
| MDF-e (Manifesto)       | `MDFE=0`         | Setar `MDFE=1`             |
| NF-e Completo           | *(no menu ERP)*  | Limpar `PRODUTO_TIPO`      |
| E-commerce              | `ECOMMERCE=0`    | Setar `ECOMMERCE=1`        |
| Locação                 | `LOCACAO=0`      | Setar `LOCACAO=1`          |
| Eventos                 | `EVENTO=0`       | Setar `EVENTO=1`           |
| Cotações                | `COTACAO=0`      | Setar `COTACAO=1`          |
| Ordens de Serviço (OS)  | `OS=0`           | Setar `OS=1`               |
| Compras / XML Entrada   | *(no menu ERP)*  | Limpar `PRODUTO_TIPO`      |
| Transportadoras / Rotas | *(no menu ERP)*  | Limpar `PRODUTO_TIPO`      |
| SPED Contábil/Fiscal    | *(no menu ERP)*  | Limpar `PRODUTO_TIPO`      |

---

## Como mudar de produto

Para voltar ao ERP completo (SLYM), edite o `.env`:

```env
# Remover ou comentar:
# PRODUTO_TIPO=mesafacil

# Reativar módulos desejados:
EVENTO=1
ECOMMERCE=1
CTE=1
MDFE=1
```

Para o futuro produto **Oficina Fácil** (mecânicas):

```env
PRODUTO_TIPO=mecanica   # (a implementar em app/Helpers/Menu.php)
OS=1
```
