# 📌 TODO.list - Trabalho de Engenharia de Software 2025.2

## 🏫 Informações Acadêmicas

- **Universidade Federal do Tocantins**
- **Curso:** Ciência da Computação
- **Disciplina:** Engenharia de Software
- **Semestre:** 4º Período – 2025.2
- **Professor:** Edeilson Milhomem
- **Alunos:** Gabriel Rodrigues, Matheus de Sousa, Rick Ribeiro, Vitória Leal e Vitória Milhomem
---

## 📖 Descrição Geral do Projeto

O **TODO.list** é uma aplicação web desenvolvida para gerenciar tarefas de forma simples e eficiente.
Através dela, o usuário pode **adicionar, editar, excluir, pesquisar e concluir tarefas.**

O projeto foi estruturado utilizando o padrão MVC (Model–View–Controller), visando a separação de responsabilidades e maior organização do código.

---

## 🎯 Objetivo

- Criar uma lista de tarefas funcional e interativa.
- Permitir a organização pessoal através da gestão de atividades.
- Exercitar a aplicação do padrão MVC.
- Utilizar o fluxo de versionamento GitFlow no desenvolvimento em equipe.

---

## ✅ Requisitos Implementados

- Tela inicial com listagem das tarefas, mostrando status (**pendente/feito**) e botões de ação (**editar, excluir, concluir**).
- Adicionar nova tarefa com formulário, salvando no tasks.json com ID automático.
- Editar tarefa existente, alterando título e salvando no JSON.
- Concluir tarefa, alterando o status para "feito" e modificando visual (tachado).
- Excluir tarefa e buscar tarefas na página principal, mantendo persistência no JSON.

---

## 🎥 Vídeo de Apresentação

📌 [Clique aqui para assistir ao vídeo](https://drive.google.com/file/d/1nGICiJhBfOxkC-WrbZim7uE5d991u-P2/view?usp=sharing)

---

## ⚙️ Instruções de Configuração e Execução Local

Para rodar o **TODO.list** usando XAMPP, siga os passos:

1. **Instalar o XAMPP**
    - Baixe e instale.
    - Abra o **Painel de Controle do XAMPP** e inicie o **Apache**.
2. **Clonar o repositório**
    
    ```bash
    git clone https://github.com/rickribeiroo/todo-list
    
    ```
    
3. **Copiar para a pasta do servidor**
    - Copie a pasta `todo-list` para `C:\xampp\htdocs\`
4. **Acessar o projeto no navegador**
    - Digite no navegador: `http://localhost/todo-list/`
5. **Usar o TODO.list**
    - Adicione, edite, conclua, busque e exclua tarefas normalmente.
    - Todas as alterações serão salvas no arquivo `tasks.json`.

---

## 📊 GitFlow e Colaboração

O desenvolvimento foi realizado utilizando o fluxo **GitFlow**, com branches:

- `main` – versão estável do projeto
- `develop` – versão em desenvolvimento
- `feature/*` – funcionalidades desenvolvidas separadamente

O **Network Graph** do GitHub demonstra a  aplicação deste fluxo.
