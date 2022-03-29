# Princípios do SOLID

1 - **S** ingle Responsability   
2 - **O** pen Close  
3 - **L** iskov Substituition    
4 - **I** nterface segregation    
5 - **D** ependency Injection    

-------------------------------

## 1 - Single Responsability
Muitas vezes o princípio da Responsabilidade Única é falada em relação à funções, porém ela é muito mais abrangente que isso.
### Variáveis:
- Deve contar apenas com uma responsabilidade;
- Não se cria uma variável genérica como $objeto e instancia classes diferentes nela no mesmo trecho de código.
### Classes:
- Não deve fazer mais do que seu escopo lhe permite;
- Se é uma Classe Jogador, ela deve conter apenas funções e atributos de um jogador, jamais ela deve conter, por exemplo, uma alteração do cenário da luta, porque isso seria escopo de uma outra classe provavelmente chamada de Cenário ou Estágio.
### Funções:
- Devem fazer apenas uma ação por chamada do método;
- Se necessário, uma função pode acionar outra função, para que uma complemente as ações da outra;
- Uma função jamais deve permitir alterar o tipo de seu retorno com base em um parâmetro, isso lhe indica que está com mais de uma responsabilidade.

------------------------------

## 2 - Open Close
Princípio do Aberto e Fechado.

------------------------------

## 3 - Liskov Substituition
Princípio da Substituição de Liskov.

------------------------------

## 4 - Interface segregation
Princípio da Segregação de Interfaces.

------------------------------

## 5 - Dependency Injection
Princípio da Injeção de Dependências.

------------------------------