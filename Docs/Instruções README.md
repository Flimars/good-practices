README.md - Requisitos básicos e instruções de criação
======================================================
​
Esta documentação visa padronizar a criação de READMEs para os projetos da Deliver IT.
​
Os padrões aqui apresentados seguem as regras básicas de documentos [Markdown](https://www.markdownguide.org/basic-syntax/)
​
Estruturas do arquivo
---------------------
​
O arquivo deve apresentar as seguintes informações (caso estejam disponíveis). Caso se faça necessário, mais seções podem ser adicionadas.
​
1. **Título do projeto e descrição básica**
​
    - Deve ser adicionado o título do projeto
    - Para criar a estrutura do título, basta adicionar, pelo menos, os três caracteres "===" na linha abaixo do texto, que deve estar na primeira linha do arquivo, por exemplo:
​
    ```markdown
    Nome do projeto
    ===
    ```
​
    - Após a estrutura do título deve ser adicionado um parágrafo com informações básicas sobre o projeto e a documentação, por exemplo:
​
    ```markdown
    Nome do projeto
    ===============
​
    Esta é a descrição do projeto. Para o título e seções também podem ser replicados os caracteres até o final da linha, como no exemplo acima.
    ```
​
1. **Tecnologias utilizadas no projeto**
​
    - A nova seção deve ser criada utilizando, pelo menos, os três caracteres "---"
    - Deve ser apresentada uma lista com as tecnologias que compõe o projeto, por exemplo:
​
    ```markdown
    Nome do projeto
    ===============
​
    Esta é a descrição do projeto...
​
    Tecnologias utilizadas
    ---------------------
​
    As tecnologias utilizadas no projeto são as seguintes:
​
    - PHP 8
    - Framework: Laravel 8
    - Banco de Dados: MySQL
    ```
​
1. **Instruções para instalação e configuração do projeto**
​
    Neste item devem ser apresentados os comandos e dependências necessários para instalação e configuração do projeto, ou montagem do ambiente, lembrando sempre que estes comandos deve ser feitos apenas para instalação.
​
    Também devem ser listadas as dependências do projeto, por exemplo, se precisa ter Docker, NPM, ou alguma ferramenta instalada na máquina host.
​
    A intenção é que seja necessário o menor número possível de comandos, deixando a aplicação o mais simples possível de ser instalada.
​
    Por exemplo, numa instalação Laravel com Docker, é importante listar os comandos para acessar o diretório de configurações do Docker, os comandos para buildar os containers, como acessa-los e as instruções de configurações básicas do Laravel (como a cópia do arquivo _.env_)
​
    **Atenção:** Devem ser listados todos os comandos necessários e, se possível, criar um Make File para caso sejam muitos. Lembre-se de que o tutorial deve ser numa linguagem simplifica e não assuma que o leitor já vai ter noção total do projeto/ambiente.
​
1. **Comandos úteis**
​
    Listar comandos úteis e para que servem, como por exemplo, acesso a containers, execuções de migrations, testes, geração de pacotes ou artefatos...
​
Ferramentas úteis
-----------------
​
Algumas ferramentas úteis na criação e edição de arquivos Markdown:
​
- Github: O Github fornece uma ótima documentação e ferramentas para a criação de arquivos _.md_ 
- VSCode: Este editor de texto possui alguns plugins que podem ajudar bastante na edição de arquivos Markdown, inclusive com validações se a estrutura está correta e com visualizador do que foi feito
    - Plugin [**markdownlint**](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint): Fornece validações e verificações de estrutura de arquivos Markdown
    - Plugin [**Markdown Preview Github Styling**](https://marketplace.visualstudio.com/items?itemName=bierner.markdown-preview-github-styles): disponibiliza um preview do arquivo que está sendo editado