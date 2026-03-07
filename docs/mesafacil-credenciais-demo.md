# Mesa Fácil — Credenciais Demo

> ⚠️ Ambiente de demonstração. **Não use em produção.**

## Empresa Demo

| Campo         | Valor                   |
|---------------|-------------------------|
| Nome          | MesaFacil Demo          |
| CNPJ          | 00.000.000/0001-00      |
| Email         | demo@mesafacil.demo     |
| Plano         | MesaFacil (R$ 149,90/mês) |
| Validade      | 31/12/2099              |

---

## Usuários

| Perfil   | Email                       | Senha    | Rota inicial               |
|----------|-----------------------------|----------|----------------------------|
| Admin    | admin@mesafacil.demo        | 12345678 | /graficos                  |
| Garçom   | garcom@mesafacil.demo       | 12345678 | /mesas                     |
| Caixa    | caixa@mesafacil.demo        | 12345678 | /caixa                     |
| Cozinha  | cozinha@mesafacil.demo      | 12345678 | /controleCozinha/selecionar|

---

## Formas de Pagamento cadastradas

- Dinheiro
- Cartão de Crédito
- Cartão de Débito
- Pix
- Vale Refeição

## Mesas cadastradas

- Mesa 1 a Mesa 10 (Área Interna)
- Balcão 1 a Balcão 3

## Categorias do cardápio

- Entradas, Pratos Principais, Pizzas, Sobremesas, Bebidas, Combos

---

## Como resetar o demo

```bash
# Apaga os dados da empresa demo e recria do zero
php artisan db:seed --class=MesaFacilDemoSeeder
```

> O seeder usa `updateOrInsert`, então é idempotente — pode ser executado mais de uma vez com segurança.
