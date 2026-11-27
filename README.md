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

Conta de demonstração: `admin@lojajogos.test` / `password`.

## Estado

A base usa SQLite local e contém registos fictícios para demonstração. Antes de entregar, substituir os dados, alterar credenciais, confirmar com o docente que o tema continua disponível, configurar Cloudinary/MySQL/Render, e preencher o relatório com o trabalho e as decisões reais do aluno. O contacto ainda não envia emails. O formulário aceita URLs de imagem; uploads Cloudinary ficam para configurar.
