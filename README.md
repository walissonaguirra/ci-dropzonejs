<div align="center">
   
   # CodeIgniter 4 - Upload de Fotos com Dropzone JS

   ![ci-dropzone-printscreen](https://github.com/walissonaguirra/ci-dropzonejs/assets/53498071/b7d35244-2c6b-44b5-8a9c-efdc62f34061)

</div>


**Um sistema simples para upload de fotos com CodeIgniter 4 e Dropzone JS**

Este projeto demonstra uma maneira fácil de fazer upload de fotos (ou outros arquivos) usando o framework CodeIgniter 4 e a biblioteca Dropzone JS.

![PHP](https://img.shields.io/badge/PHP-%5E8.0-blue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-%5E4.5.3-blue)
![Dropzone](https://img.shields.io/badge/Dropzone-%5E5.9.3-blue)
![License](https://img.shields.io/badge/Code%20License-MIT-blue.svg)

## Funcionalidades:

- Upload de fotos
- Visualização das fotos enviadas
- Progresso do upload em tempo real
- Validação de arquivos (tamanho, tipo, etc.)
- Salvamento das fotos no servidor
- Capacidade de apagar fotos

## Guia de instalação

1. Clone o Repositório:
   
```sh
git clone https://github.com/walissonaguirra/ci-dropzonejs && cd ci-dropzonejs
```

2. Instale as Dependências:
   
```sh
composer install
```

3. Configure o Banco de Dados:
Copie e renomei o arquivo `env` para `.env` e configure a conexão com o banco de dados que você deseja usar. O exemplo abaixo configura um banco de dados SQLite:

```dotenv
database.default.database = database.db
database.default.DBDriver = SQLite3
```

4. Execute as Migrations:
```sh
php spark migrate
```

5. Inicie o Servidor:

```sh
php spark serve
```

6. Pronto!! Acesse a URL http://localhost:8080 em seu navegador para ver o projeto em ação.

## Contribuidores

<a href="https://github.com/walissonaguirra/ci-dropzonejs/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=walissonaguirra/ci-dropzonejs" />
</a>

## Licença

Este projeto está licenciado sob a licença MIT.
