# Boas Práticas e Código Limpo

## Comentários

*"Ahhh... os insólitos comentários.  
Você pode não notá-los,  
pode não entendê-los,  
mas eles estão ali.  
E justamente não notá-los ou entendê-los  
é o grande problema,  
se um comentário chegou à esse ponto,  
já parte do príncipio que ele não devia existir."*  

--------------------------------

- Comentários são uma coisa complicada, começamos daqui!
- Quando se comenta algo, um trecho de código por exemplo, significa que ele não está tão bem explícito como deveria. Nesse caso, ainda temos o problema de mantér, além do código atualizado, esse comentário também atualizado.
- Um comentário pode ser esquecido no meio do código, fazendo com que sua importância se torne um incômodo incoveniente para novos desenvolvedores, que terão que entender do que se trata.
- Um comentário sobre uma função jamais deve ter o objetivo de explicar para que ela serve, visto que seu nome deve dizer isso: vide [Funções](Funcoes.md).
- Um comentário sobre uma variável, exceto como documentação específica e previamente acordada pela equipe, deve ser evitado.
- Um comentário sobre uma Classe é conhecido como Bloco de Documentação e, de todos os casos, é o mais aceitável, visto que além de explicar o objetivo da classe, também direciona sua atenção para o Principio do Aberto e Fechado e da Responsabilidade Única. Se esse bloco de documentação precisar ser alterado, é possível que você esteja quebrando algum dos princípios do [SOLID](SOLID.md).
- Qualquer comentário, **QUALQUER UM** deles, mesmo os que não deveriam existir, devem ser bem escritos, para que o próximo desenvolvedor que trabalhar no código saiba do que se trata e possa melhora o código ao ponto de eliminar esse comentário.
- Algumas vezes consideramos eles necessários, outras vezes os escrevemos para deixar uma mensagem engraçada para o próximo colega, mas **geralmente eles descrevem as nossas falhas** em escrever um código claro e devem ser evitados à qualquer custo.
- Jamais deixe códigos comentados, para versionamento de código utilize ferramentas como o GIT, elimine-os e limpe caminho para novos códigos.  

--------------------------------

## Exemplos

Exemplo de comentário que pode ser aplicado, com cautela.

```PHP
/**
 * Esse é um DOC BLOCK aceito.
 * Essa classe é responsável por lidar com a tabela characters do Banco de Dados
 * Nao deve possui funções, apenas representar o Active Record.
 * Qualquer função extra deve ser escrita na CharacterRepository.
 */
class CharacterModel
{
    //...
}
```

No exemplo abaixo um comentário desnecessário, seria melhor especificar seu objetivo no nome da função e redundância, já que estamos lidando com a Controladora de Personagens.

```PHP
class CharacterController
{

  //Essa funçao irá listar todos os personagens desativados no ultimo deploy.
  public function listInactives()
  {
    //...
  }
}
```

Reescrevendo a função acima e evitando utilizar comentário, ficaria assim:

```PHP
class CharacterController
{
  public function listAllDeactivatedOnLastDeploy()
  {
    //...
  }
}
```

[Início](PHP.md)
