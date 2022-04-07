# Boas Práticas e Código Limpo

## Classes

1. Classes podem representar várias coisas, como Assuntos, Objetos ou Entidades, cada uma com suas determinadas funções e atributos.
2. Diferente das variáveis, o nome de uma Classe deve ser *Inversamente Proporcional* ao seu Escopo, uma Classe muito abrangente, deve ter um nome genérico e curto, para facilitar o seu entendimento, classes mais específicas devem ter nomes mais complexos e específicos.
3. Classes também devem seguir o Principio da Reponsabilidade Única, porém diferente das funções e variáveis, o objetivo é entender qual o assunto dessa classe, uma Classe chamada Aves jamais deve ter uma função que calcula a velocidade máxima alcançada por uma pessoa correndo, talvez por uma ave voando sim, mas pessoa jamais.
4. Comentários que expliquem o objetivo da classe podem ser usados, se houver necessidade de alteração desse comentário, provavelmente indica que você está ferindo o Princípio do Aberto e Fechado do SOLID, pois você precisou alterar essa classe incluindo mais funções e talvez até ferindo o principio da Responsabilidade Única. Vide [Comentários](Comentarios.md).
5. O uso de herança e abstração nas classes é recomendado sempre que possível e garante evitar a quebra do princípio do Aberto e Fechado, pois dessa forma é possível estender a classe, porém não é necessário alterá-la. Vide [SOLID](SOLID.md).
6. Abertura de chaves **"{ }"** deve sempre iniciar na linha abaixo da declaração da Classe e encerrar na linha abaixo da última linha de código.
7. Sempre deixar uma linha vazia após o fechamento da ultima chave no arquivo.
8. Utilizar o padrão **PascalCase** para definir o nome da Classe.
9. Manter os parênteses de parâmetros sem espaçamento do nome da classe.
10. Sempre que uma classe for instanciada, deve-se usar os parenteses na frente do nome, mesmo que não haja parâmetros.

-------------------------

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

Ruim

```PHP
//Uma classe Controller possui a única e específica responsabilidade de gerenciar requisições e respostas.
//Nenhuma regra de negócios ou consulta ao banco deve ser implementada na Controller.
class CharacterController
{
  public function __construct()
  {
    //Código...
  }

  public function all()
  {
    //É ERRADO o uso de regras de negócio nas controladoras.
    if ($this->userHasPermission()) {
      //É ERRADO a consulta direta ao Banco de Dados pela Controladora.
      return DB::table('characters')->all();
    }

    return [];
  }
}

class Animal { // <- Abertura de chaves na mesma linha da declaração da Classe.
  public function __construct()
  {
    //Código...
  }
}
```

Bom

```PHP
//A Classe controladora instancia a Service, onde contém as regras de negócio
//A Service por sua vez aciona a Model ou Repository, para a consulta ao banco de dados.
class AnimalController
{
  private $animalService;

  public function __construct()
  {
    $this->animalService = (new AnimalService()); //<- a Classe service foi instanciada corretamente.
  }

  public function all(Request $request)
  {
    return $this->characterService->all();
  }
}

//Essa classe possui métodos específicos para o seu objetivo, no caso, tudo relacionado à Animais.
//A classe pode ser estendida, mas não precisa ser modificada.
class Animal
{
  public function __construct()
  {
    //Código...
  }

  public function all()
  {
    //Código...
  }

  public function habitat()
  {
    //Código...
  }
}

//Para funções relacionadas à aves, criamos uma nova classe e herdamos a classe Animal.
class Aves implements Animal
{
  public function __construct()
  {
    parent::__construct();
  }

  public altitudeReached()
  {
    //Código...
  }
}
```

[Início](PHP.md)