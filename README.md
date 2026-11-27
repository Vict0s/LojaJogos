# Loja de Jogos

Projeto inicial de ACR em Laravel 12 com Laravel Breeze (Blade), autenticação, catálogo público de jogos, categorias, pesquisa, ordenação, destaque aleatório, gestão CRUD reservada a administradores e dados de demonstração.

## Abrir no Windows

1. Abre o CMD.
2. Executa:

```bat
cd /d "%USERPROFILE%\Downloads\LojaJogos"
Iniciar-Loja.cmd
```

O navegador abre em `http://127.0.0.1:8000`. Mantém a janela do CMD aberta enquanto usas a loja. Para parar o servidor, prime `Ctrl+C`.

Conta local de demonstração: utilizador `123` / palavra-passe `123`. No Render, usa o email `admin@lojajogos.test` e a palavra-passe gerada no serviço.

## Estado

A base usa SQLite local e contém registos fictícios para demonstração. Antes de entregar, substituir os dados, alterar credenciais, confirmar com o docente que o tema continua disponível, configurar Cloudinary/MySQL/Render, e preencher o relatório com o trabalho e as decisões reais do aluno. O contacto ainda não envia emails. O formulário aceita URLs de imagem; uploads Cloudinary ficam para configurar.

## Publicação de demonstração no Render

O ficheiro render.yaml configura a aplicação Laravel em Docker e uma base de dados PostgreSQL gratuita. No Render, escolhe New > Blueprint, liga o repositório Vict0s/LojaJogos e confirma o plano Free para os dois serviços. A configuração semeia as categorias e os jogos de demonstração no primeiro arranque.

O administrador usa o email admin@lojajogos.test. A palavra-passe é gerada pelo Render e aparece na variável ADMIN_PASSWORD do serviço; mantém esse valor privado. A base de dados gratuita do Render expira após 30 dias e os serviços gratuitos podem suspender-se quando ficam sem acessos.