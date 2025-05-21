<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## mini ERP em Laravel
## Passo 1 - Informações sobre a aplicação
- Clone do projeto pelo link [Github](https://github.com/walquiriosaraiva/MiniERP.git)
- Copie o conteúdo do arquivo .env.example para .env utilizando o comando `cp .env.example .env`
## Passo 2 - docker-compose
- Execute o comando `docker-compose up -d`
- Com o comando acima o projeto MiniERP irá ficar up em [localhost](http://localhost/dev/routes), lá haverá um menu para as rotas: Produtos, Carrinho, Pedidos e Rotas.

## Passo 3 - rodando os container adicionais para manipular comandos Composer e Artisan
- Execute o comando do composer update `docker-compose run --rm composer update`
- Execute o comando `docker-compose run --rm artisan migrate`

## Para criar arquivos com o artisan
- docker-compose run --rm artisan make:model Produto -mcr
- docker-compose run --rm artisan make:model Variacao -m
- docker-compose run --rm artisan make:model Estoque -m
- docker-compose run --rm artisan make:model Pedido -mcr
- docker-compose run --rm artisan make:model Cupom -mcr
- docker-compose run --rm artisan migrate

### o que foi criado
Models (app/Models)
Migrations (database/migrations)
Controllers (app/Http/Controllers)
Rotas automáticas para ProdutoController, PedidoController, CupomController

## testar webhook - Testar atualização
```bash
curl -X POST http://localhost/api/webhook/pedido \
     -H "Content-Type: application/json" \
     -d '{"id":1,"status":"entregue"}'
```

## testar webhook - Testar cancelamento
```bash
curl -X POST http://localhost/api/webhook/pedido \
     -H "Content-Type: application/json" \
     -d '{"id":1,"status":"cancelado"}'
```
## se não quiser enviar e-mail do pedido solicitado comentar a linha do arquivo PedidoController ou atualize o .env com suas credenciais para envio do e-mail, no meu caso usei o mailtrap
```bash
Mail::to($pedido->email_cliente)->send(new PedidoFinalizadoMail($pedido));
```

## não há necessidade de gerar o sql, pois o mesmo foi gerado com a migration do laravel, basta executar no container, caso queira o arquivo está no diretório do projeto
- backup_mini_erp.sql
