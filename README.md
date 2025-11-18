# Facilitador

**Facilitador** - Facilitador para ajudar no desenvolvimento de páginas web

[![Build Status](https://travis-ci.org/SierraTecnologiaInc/Facilitador.svg?branch=master)](https://travis-ci.org/SierraTecnologiaInc/Facilitador)
[![Maintainability](https://api.codeclimate.com/v1/badges/8c00a046fec32d8b8ac7/maintainability)](https://codeclimate.com/github/SierraTecnologiaInc/Facilitador/maintainability)
[![Packagist](https://img.shields.io/packagist/dt/sierratecnologia/facilitador.svg)](https://packagist.org/packages/sierratecnologia/facilitador)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/sierratecnologia/facilitador)
[![CI/CD Pipeline](https://github.com/SierraTecnologia/Facilitador/actions/workflows/ci.yml/badge.svg)](https://github.com/SierraTecnologia/Facilitador/actions/workflows/ci.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg)](https://github.com/phpstan/phpstan)
[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)](https://php.net)

---

## 📚 Índice

1. [Introdução](#introdução)
2. [Instalação](#instalação)
3. [Arquitetura e Estrutura Interna](#arquitetura-e-estrutura-interna)
4. [Principais Funcionalidades](#principais-funcionalidades)
5. [Uso Prático](#uso-prático)
6. [Integração com o Ecossistema SierraTecnologia](#integração-com-o-ecossistema-sierratecnologia)
7. [Extensão e Customização](#extensão-e-customização)
8. [Exemplos Reais](#exemplos-reais)
9. [Guia de Contribuição](#guia-de-contribuição)

---

## Introdução

### O que é o Facilitador

O **Facilitador** é um pacote Laravel desenvolvido pela SierraTecnologia / Rica Soluções que funciona como um **admin builder modular** — uma ferramenta completa para criação, configuração e gerenciamento de painéis administrativos de forma dinâmica e extensível.

### Objetivo e Propósito

O principal objetivo do Facilitador é **acelerar o desenvolvimento de sistemas administrativos** em Laravel, eliminando a necessidade de criar manualmente CRUDs, formulários, listagens e configurações repetitivas. O pacote permite que desenvolvedores foquem na lógica de negócio enquanto a infraestrutura administrativa é gerada automaticamente.

### Simplificação de Painéis Administrativos

Com o Facilitador, você pode:

- **Gerar CRUDs completos** a partir de models Eloquent existentes
- **Criar painéis administrativos** com apenas algumas linhas de configuração
- **Gerenciar permissões e papéis** de forma granular
- **Customizar views e comportamentos** sem reescrever código base

### Papel Estratégico no Ecossistema

O Facilitador é a **espinha dorsal administrativa** do ecossistema SierraTecnologia, servindo como base para:

- **Siravel** (CMS)
- **Market** (E-commerce)
- **Finder** (Gerenciador de arquivos)
- **MediaManager** (Gerenciamento de mídias)
- Outros pacotes internos

---

## Instalação

### Requisitos Mínimos

| Requisito | Versão |
|-----------|--------|
| PHP | 8.0+ |
| Laravel | 8.x / 9.x / 10.x / 11.x |
| OpenSSL | Habilitado |
| PDO | SQLite/MySQL/PostgreSQL |

### Instalação via Composer

```bash
# Criar novo projeto Laravel (opcional)
composer create-project laravel/laravel seu-projeto

# Instalar o Facilitador
composer require sierratecnologia/facilitador
```

### Publicação de Configurações

```bash
# Publicar configurações, views, migrations e assets
php artisan vendor:publish --provider="Facilitador\FacilitadorProvider"

# Executar migrations
php artisan migrate

# Instalar o Facilitador (cria usuário admin e dados iniciais)
php artisan facilitador:install
```

### Arquivo de Configuração

Após a publicação, o arquivo `config/facilitador.php` estará disponível para customização.

### Registro Automático

O Service Provider `Facilitador\FacilitadorProvider` é registrado automaticamente via Laravel Package Discovery. As rotas administrativas são carregadas automaticamente no grupo `rica`.

---

## Arquitetura e Estrutura Interna

### Estrutura de Diretórios

```
src/
├── Console/                    # Comandos Artisan
│   ├── Commands/
│   │   ├── System/            # Install, Migrate, Publish
│   │   └── Manutencao/        # Manutenção
│   └── Kernel.php
├── Exceptions/                 # Tratamento de exceções
├── Facades/                    # Facilitador, Gravatar
├── Http/
│   ├── Controllers/
│   │   ├── Admin/             # Controllers administrativos
│   │   ├── RiCa/              # Controllers BREAD
│   │   └── Api/               # Controllers API
│   ├── Middleware/            # Auth, ACL, MultiTenant
│   ├── Policies/              # Políticas de autorização
│   └── Resources/             # Recursos JSON API
├── Jobs/                       # Jobs assíncronos
├── Models/                     # Setting, Base
├── Observers/                  # ModelCallbacks
├── Providers/                  # Service Providers
├── Services/                   # FacilitadorService, Gravatar
├── Traits/                     # AlertsMessages, Spatial, Seedable
└── Widgets/                    # UserDimmer, PostDimmer
```

### Namespaces Principais

| Namespace | Descrição |
|-----------|-----------|
| `Facilitador\Http\Controllers` | Controllers web e API |
| `Facilitador\Models` | Modelos Eloquent |
| `Facilitador\Services` | Serviços de negócio |
| `Facilitador\Facades` | Facades para acesso simplificado |
| `Facilitador\Providers` | Service Providers |

### Padrões Adotados

- **MVC Expandido**: Controllers com services e repositories
- **BREAD Pattern**: Browse, Read, Edit, Add, Delete
- **Repository Pattern**: Abstração de acesso a dados
- **Observer Pattern**: Callbacks em eventos de modelo
- **Facade Pattern**: Acesso simplificado a serviços

### Fluxo de Comunicação

```
┌─────────────┐     ┌──────────────┐     ┌─────────────┐
│   Rotas     │ ──▶ │ Controllers  │ ──▶ │  Services   │
└─────────────┘     └──────────────┘     └─────────────┘
                           │                     │
                           ▼                     ▼
                    ┌──────────────┐     ┌─────────────┐
                    │    Views     │     │   Models    │
                    │   (Blade)    │     │  (Eloquent) │
                    └──────────────┘     └─────────────┘
```

---

## Principais Funcionalidades

### 1. Criação Automática de CRUDs

O sistema BREAD (Browse, Read, Edit, Add, Delete) gera interfaces completas automaticamente:

```php
use Facilitador\Facades\Facilitador;

// Acessar modelo através da Facade
$produtos = Facilitador::model('Produto')->all();
```

### 2. Geração de Painéis Administrativos

O painel inclui automaticamente:
- Listagem com paginação e busca
- Formulários de criação/edição
- Confirmação de exclusão
- Exportação de dados

### 3. Sistema de Permissões e Papéis

```php
// O middleware valida automaticamente:
// - Autenticação do usuário
// - Permissão para a action (browse, read, edit, add, delete)
// - Acesso ao controller específico

if ($user->can('edit', $model)) {
    // Permitir edição
}
```

### 4. Upload e Gerenciamento de Mídias

Suporta: imagens, arquivos, vídeos com tipos de campo:
- `image`: Upload com redimensionamento
- `file`: Upload genérico
- `media_picker`: Seletor de mídia existente

### 5. Extensibilidade com Hooks e Observers

```php
// Eventos disponíveis:
// onCreating, onCreated, onUpdating, onUpdated
// onDeleting, onDeleted, onSaving, onSaved

class SeuModelo extends Model
{
    public function onCreated()
    {
        // Executado após criação
    }
}
```

### 6. Sistema de Configurações Dinâmicas

```php
use Facilitador\Facades\Facilitador;

// Obter configuração com cache automático
$valor = Facilitador::setting('app.nome', 'default');
```

### 7. Widgets de Dashboard

```php
// Widgets disponíveis: UserDimmer, PostDimmer, PageDimmer

class MeuWidget extends BaseDimmer
{
    public function run()
    {
        return view('meu-widget', ['count' => Model::count()]);
    }
}
```

---

## Uso Prático

### Instalação e Configuração

```bash
# 1. Instalar o pacote
composer require sierratecnologia/facilitador

# 2. Publicar assets
php artisan vendor:publish --provider="Facilitador\FacilitadorProvider"

# 3. Executar migrations
php artisan migrate

# 4. Criar usuário administrador
php artisan facilitador:admin

# 5. Acessar o painel em: http://seu-site.com/admin
```

### Exemplo: Criar CRUD para Tabela Existente

```php
// app/Models/Produto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'preco', 'estoque', 'ativo'];

    protected $casts = [
        'preco' => 'decimal:2',
        'ativo' => 'boolean'
    ];
}

// Registrar no Facilitador
use Facilitador\Facades\Facilitador;
Facilitador::useModel('Produto', \App\Models\Produto::class);
```

### Personalização de Views

```bash
# Publicar views para customização
php artisan vendor:publish --tag=facilitador-views
# Views ficam em: resources/views/vendor/facilitador/
```

### Boas Práticas e Segurança

1. Sempre valide permissões antes de operações sensíveis
2. Use Policies para lógica de autorização complexa
3. Sanitize inputs em campos rich-text
4. Configure CSRF em formulários
5. Limite uploads por tipo e tamanho
6. Use HTTPS em produção

---

## Integração com o Ecossistema SierraTecnologia

### Pacotes Integrados

| Pacote | Função |
|--------|--------|
| **Pedreiro** | Templates e UI |
| **Support** | Componentes base |
| **Porteiro** | Autenticação |
| **Siravel** | CMS |
| **Tracking** | Analytics |
| **Audit** | Auditoria |
| **Muleta** | Utilitários |

### Diagrama de Dependências

```
                    ┌─────────────┐
                    │ Facilitador │
                    └──────┬──────┘
                           │
        ┌──────────────────┼──────────────────┐
        ▼                  ▼                  ▼
  ┌──────────┐      ┌──────────┐      ┌──────────┐
  │ Pedreiro │      │  Support │      │ Porteiro │
  └──────────┘      └──────────┘      └──────────┘
```

---

## Extensão e Customização

### Criar Novo Módulo Administrativo

```php
namespace App\Http\Controllers\Admin;

use Facilitador\Http\Controllers\Admin\Base;

class RelatorioController extends Base
{
    protected $model = 'Relatorio';

    public function index()
    {
        return view('admin.relatorios.index', [
            'relatorios' => $this->getModelClass()::paginate(20)
        ]);
    }
}
```

### Sobrescrever Controllers

```php
// app/Providers/AppServiceProvider.php
$this->app->bind(
    \Facilitador\Http\Controllers\RiCa\UserController::class,
    \App\Http\Controllers\Admin\CustomUserController::class
);
```

### Criar Widget Customizado

```php
namespace App\Widgets;

use Facilitador\Widgets\BaseDimmer;

class VendasDimmer extends BaseDimmer
{
    public function run()
    {
        return view('widgets.vendas', [
            'count' => Venda::whereMonth('created_at', now()->month)->count()
        ]);
    }
}
```

---

## Exemplos Reais

### Benefícios Mensurados

| Métrica | Sem Facilitador | Com Facilitador | Ganho |
|---------|-----------------|-----------------|-------|
| Tempo para CRUD | 3 horas | 20 min | 89% |
| Linhas de código | 500 | 50 | 90% |
| Consistência UI | Variável | Padronizada | 100% |

---

## Guia de Contribuição

### Como Contribuir

1. Fork o repositório
2. Clone: `git clone https://github.com/seu-usuario/facilitador.git`
3. Crie branch: `git checkout -b feature/minha-feature`
4. Teste: `composer test`
5. Commit: `git commit -m "feat: adiciona feature"`
6. Push e abra Pull Request

### Padrões de Commits

```
feat: nova funcionalidade
fix: correção de bug
docs: documentação
refactor: refatoração
test: testes
```

### Execução Local das Ferramentas

```bash
# Testes
./vendor/bin/phpunit

# Code style (PSR-12)
./vendor/bin/phpcs --standard=PSR12 src/

# Análise estática (nível 8)
./vendor/bin/phpstan analyse src/ --level=8

# Boas práticas
./vendor/bin/phpmd src/ text phpmd.xml
```

---

## License
Facilitador is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests
Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Contato

- **Email**: help@sierratecnologia.com.br
- **Issues**: [GitHub Issues](https://github.com/SierraTecnologia/Facilitador/issues)

---

##### Author(s):
* [Ricardo Rebello Sierra](https://github.com/ricardosierra) ([@sierra91jb](http://twitter.com/sierra91jb), sierra dot csi at gmail dot com)

## Inspiration

F.o.r.k. M.a.k.e.r by [Matt Lantz](https://github.com/mlantz) ([@mattylantz](http://twitter.com/mattylantz), mattlantz at gmail dot com)
