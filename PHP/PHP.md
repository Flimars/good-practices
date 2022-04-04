# Conceitos de Clean Code e Boas Práticas para PHP

Publicado em 04/04/2022

Autor: Gabriel Bruno Almeida

>*"Guia adaptado de experiências pessoais e das referências ao final deste documento."*

# Introdução

## O que são as boas práticas e os conceitos de código limpo?

Basicamente o que temos que pensar é que não existem regras para se escrever um código como existe para escrever um livro, não temos uma norma ABNT que define quais espaçamentos e número de linhas uma página deve ter, para isso precisamos criar essas definições e segui-las do inicio ao fim do desenvolvimento do projeto.

Algumas linguagens de programação, como o PHP ou o C#, possuem documentos criados pela comunidade com uma série de boas práticas para se aplicar ao desenvolver, porém, além dessas boas práticas, também temos mais informações com livros como Clean Code, de Robert C. Martin, ou os principios do SOLID e também os princípios da Calistenia de Objetos. Se você conseguir unir as boas práticas dessas diversas fontes, com certeza será capaz de criar um código muito mais prático, claro e de fácil manutenção.

Eu poderia citar trechos do livro Clean Code, referenciado ao final desse documento, para diversas situações, porém aqui estamos falando de uma documentação criada e mantida por nós, da Deliver IT, portanto é algo que cabe à nós discutir e aprimorar conforme nossas próprias decisões.

Faça um esforço, leia a documentação, entenda os pontos aqui aplicados e se necessário procure o seu Líder Técnico, um colega, ou até eu, o autor desse documento, que com certeza teremos esclarecimentos para lhe dar e garantir que o maior número possível de práticas descritas aqui seja implementada e possamos manter essa documentação atualizada e constantemente incrementada.

## Porque usar isso no meu projeto?

Quando você vai implementar uma nova funcionalidade em um sistema, já parou para analisar quantas vezes você lê o código durante a implementação? Conforme citado no livro Clean Code, a taxa de leitura para escrita na hora de programar é de 10x1.

> Você lê o código,  
> Começa a escrever uma linha,  
> Volta até a função anterior e lê,  
> Vai na classe e lê,  
> Volta para sua linha e apaga.  
> Lê novamente o código...  
> E assim sucessivamente, até enfim conseguir escrever algumas poucas linhas de código.

Esse processo pode ser muito mais simples se o código estiver bem escrito. Uma coisa muito legal que já tinha ouvido falar e depois descobri que faz parte do livro Clean Code é:

> Escrever um código é como escrever um livro.  
> O seu código deve contar uma história,  
> Trazer o leitor para dentro dele,  
> Fazê-lo sentir parte daquilo,  
> E direcioná-lo corretamente para o caminho que deve seguir na leitura.

É importante citar que qualquer código pode ser trabalhado pouco a pouco, basta que cada desenvolvedor aplique algumas dessas práticas conforme for implementando suas funcionalidades ou correções, bem como o revisor pode sugerir ao desenvolvedor algumas melhorias, de forma que esse código, mesmo que leve 10 anos, venha um dia a se tornar um código limpo. É o que sugere a regra abaixo que vem muito à calhar para a nossa área.

> Deixe a área do acampamento mais limpa do que como você à encontrou!  
> \- _Regra dos escorteiros da **Boys Scouts of America**_


-----------------------------

Bom, sem mais delongas, vamos aos assuntos dessa documentação:

1. [Variáveis](Variaveis.md)
2. [Funções](Funcoes.md)
3. [Classes](Classes.md)
4. [Estruturas Condicionais e de Repetição](Estruturas.md)
5. [SOLID](SOLID.md)
6. [Comentários](Comentarios.md)

Espero que esse guia seja útil para quem está lendo tanto quanto foi útil para mim enquanto eu escrevia este documento.

# Referências

##### [Princípios SOLID Series Articles](https://dev.to/lucascavalcante/series/6852)
##### [PHP-FIG - PSR's](https://www.php-fig.org/psr/)
##### [Martin, R. C. (2019). Código Limpo: Habilidades Práticas do Agile Software. Brasil: Alta Books.](https://www.google.com/aclk?sa=L&ai=DChcSEwjM2JH8u_b2AhXECpEKHbfdCscYABAOGgJjZQ&sig=AOD64_2I5BFrxKgOwCXwM7Scgz-fh-dNPg&ctype=5&q=&ved=2ahUKEwianIb8u_b2AhXasJUCHbVkCicQ9aACegQIAhBE&adurl=)
##### [Object Calisthenics - William Durand](https://williamdurand.fr/2013/06/03/object-calisthenics/)