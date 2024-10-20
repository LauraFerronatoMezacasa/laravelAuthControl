# Laravel Auth Control 

**Descrição do Projeto:**
Este projeto consiste em uma aplicação desenvolvida em PHP/Laravel que oferece um sistema de gerenciamento de usuários e controle de permissões, permitindo o cadastro e manutenção de usuários com diferentes níveis de acesso.

## Funcionalidades
- Sistema de login com controle de permissões baseado no nível de acesso do usuário.
- Dois níveis de acesso padrão: **Comum** e **Administrador**.
- O administrador pode criar, modificar e excluir usuários e permissões.
- Usuários com acesso comum podem visualizar e editar suas próprias informações, mas não gerenciar outros usuários, nem permissões. 
- Possibilidade de adicionar novos tipos de acesso personalizados.

## Regras de Negócio
1. Nenhum usuário pode alterar ou excluir o usuário **Administardor**.
2. O usuário logado não consegue editar ou excluir seu próprio usuário na listagem de usuários.
3. O usuário logado não consegue excluir o tipo de acesso que possui.
4. O tipo de acesso **Administrador** não pode ser excluído nem alterado.
5. O usuário **Comum** só pode ser alterado.

## Tecnologias Utilizadas
- PHP/Laravel
- MySQL/SQLServer
- Bootstrap (para a interface)

---

## Como Instalar o Projeto

Para instalar o projeto na sua máquina local, siga os passos abaixo:

### Pré-requisitos
Antes de começar, você precisará ter instalado em sua máquina:
- PHP (versão 7.3 ou superior)
- Composer (gerenciador de pacotes PHP)
- Um servidor de banco de dados (MySQL ou SQL Server)
- Um servidor web (como Apache ou Nginx)

### Passos de Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/SEU_USUARIO/NOME_DO_REPOSITORIO.git

2. **Navegue até o repositório do projeto**
    ```bash
    cd NOME_DO_REPOSITORIO

3. **Instale as dependências do projeto:**
    ```bash
    composer install

4. **Crie um arquivo .env: Copie o arquivo de exemplo .env.example para criar seu arquivo .env:**
    ```bash
    cp .env.example .env

5. **Configure o banco de dados: Abra o arquivo .env e configure as credenciais do seu banco de dados:**
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_seu_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

6. **Gere a chave de aplicativo:**
    ```bash
    php artisan key:generate

7. **Execute as migrações para criar as tabelas no banco de dados:**
    ```bash
    php artisan migrate

8. **Popule o banco de dados com dados iniciais usando seeders:**
    ```bash
    php artisan db:seed

9. **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve

10. **Agora é só acessar a aplicação:**
    ```bash
    http://localhost:8000 ou http://127.0.0.1:8000

---

## Automação de Login com Selenium

Este projeto inclui um script de automação que utiliza o Selenium para simular o login na aplicação Laravel.

### Pré-requisitos

- **Antes de executar o script, você precisará ter o Selenium instalado. Execute o seguinte comando para instalar o Selenium via pip:**
    ```bash
    pip install selenium


### Executando o Script

O script de automação está localizado na pasta `scripts`. Para executar o script, siga os passos abaixo:

1. **Navegue até a pasta do script:**
   ```bash
   cd scripts

2. **Execute o script usando Python (exemplo):**
    ```bash
    python3 login_automation.py


### Observações

- O script fará o login na aplicação com as credenciais fornecidas.
- Para visualizar a simulação, você pode observar a janela do navegador durante a execução do script.
- Certifique-se de que a aplicação Laravel esteja rodando em seu ambiente local antes de executar o script.

Muito obrigada! 
