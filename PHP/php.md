# Conceitos de Clean Code e Boas Práticas para PHP

Escrito em: 02/04/2022

Autor: Gabriel Bruno Almeida

- *"Guia adaptado de experiências pessoais e das referências ao final deste documento."*

# Introdução

Boas práticas devem ser usadas com bom senso!

1. Muitos dos princípios podem não se adequar ao seu código atual ou equipe.
2. Alguns desses princípios não são universalmente aceitos.
3. De acordo com trecho do livro Clean Code, de Robert C. Martin, esses princípios foram "*criados e aprimorados coletivamente através de anos de prática e experiência*" pelos colaboradores do livro e também por mim, que lhes escrevo.

# Quais os motivos de utilizar este guia em meus trabalhos?

Este guia lhe dirá algumas verdades que talvez você ainda não tenha notado ou talvez ignorado, porém que são fatos na vida de um programador.

* Ao programar, você irá ler muito mais do que escrever, um código bem escrito facilita essa leitura.
* Todo código pode conter armadilhas, elas devem ser corrigidas com cuidado e o mais rápido possível.
* Um código pode possuir muitas classes, funções e variáveis, mas a leitura deve ser leve e simples.
* Perfomance e Segurança devem sempre ser levados em conta ao aplicar boas práticas.
* Empresas já encerraram atividades porque suas aplicações se tornam tão difíceis de manter que não se pagam mais.

Este guia foi divido por assuntos, conforme índice abaixo:

1. [Variáveis](Variaveis.md)
2. [Funções](Funcoes.md)
3. [Classes](Classes.md)
4. [Estruturas de dados](Dados.md) *--**WIP** - Citar Early Return e aninhamentos excessivos.*
5. [SOLID](SOLID.md)
6. [Comentários](Comentarios.md)

Espero que esse guia seja útil para quem está lendo tanto quanto foi útil para mim enquanto eu escrevia este documento.

# Referências

##### [Princípios SOLID Series Articles](https://dev.to/lucascavalcante/series/6852)
##### [PHP-FIG - PSR's](https://www.php-fig.org/psr/)
##### [Martin, R. C. (2019). Código Limpo: Habilidades Práticas do Agile Software. Brasil: Alta Books.](https://www.google.com/aclk?sa=L&ai=DChcSEwjM2JH8u_b2AhXECpEKHbfdCscYABAOGgJjZQ&sig=AOD64_2I5BFrxKgOwCXwM7Scgz-fh-dNPg&ctype=5&q=&ved=2ahUKEwianIb8u_b2AhXasJUCHbVkCicQ9aACegQIAhBE&adurl=)