# Boas Práticas e Código Limpo

## Classes!
### Pontos importantes:
- Classes podem representar várias coisas, como Assuntos, Objetos ou Entidades, cada uma com suas determinadas funções e atributos.
- Diferente das variáveis, o nome de uma Classe deve ser Inversamente Proporcional ao seu Escopo, uma Classe muito abrangente, deve ter um nome genérico e curto, para facilitar o seu entendimento, classes mais específicas devem ter nomes mais complexos e específicos.
- Classes também devem seguir o Principio da Reponsabilidade Única, porém diferente das funções e variáveis, o objetivo é entender qual o assunto dessa classe, uma Classe chamada Aves jamais deve ter uma função que calcula a velocidade máxima alcançada por uma pessoa correndo, talvez por uma ave voando sim, mas pessoa jamais.
- Comentários que expliquem o objetivo da classe podem ser usados, se houver necessidade de alteração desse comentário, provavelmente indica que você está ferindo o Princípio do Aberto e Fechado do SOLID, pois você precisou alterar essa classe incluindo mais funções e talvez até ferindo o principio da Responsabilidade Única.
- O uso de Herança nas classes é recomendado sempre que possível e garante evitar a quebra do princípio do Aberto e Fechado, pois dessa forma é possível estender a classe, porém não é necessário alterá-la.
</br>

## Boas Práticas - PSR's *(Link ao final do documento)*
### - As classes devem seguir as seguintes boas práticas:
  - Abertura de chaves "{ }" deve sempre iniciar na linha abaixo da declaração da Classe e encerrar na linha abaixo da ultima linha de código.
  - Sempre deixar uma linha vazia após o fechamento da ultima chave no arquivo.
  - Utilizar o padrão **PascalCase** para definir seu nome.
  - Manter os parênteses sem espaçamento do nome da função.
  - Sempre que uma classe for instanciada, deve-se usar os parenteses na frente do nome, mesmo que não haja parâmetros.  
</br>

-------------------------
## Exemplos  
</br>

```PHP
/**
 * Esse é um DOCBLOCK
 * A classe CharacterModel representa o banco de dados e todas as suas funções relacionadas à banco de dados
 * Aqui não cabe regras de negócios, apenas e exclusivamente entradas e saídas de banco de dados.
 */
class CharacterModel
{
    //Código de consulta ao banco de dados aqui.
}
```

```PHP
//INCORRETO - Uma classe Controller possui a única e específica responsabilidade de gerenciar requisições e respostas, nenhuma regra de negócios ou consulta ao banco deve ser implementada na Controller.
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

//CORRETO - A Classe controladora instancia a Service, onde contém as regras de negócio, a Service por sua vez aciona a Model ou Repository, para a consulta ao banco de dados.
class CharacterController
{
  private $characterService;

  public function __construct()
  {
    $this->characterService = (new CharacterService());
  }

  public function all()
  {
    return $this->characterService->all();
  }
}
```
```PHP
//CORRETO
//A classe possui métodos específicos para o seu objetivo, no caso, tudo relacionado à Animais.
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

//Para funções relacionadas à aves, devemos criar uma nova classe e herdar a classe Animal.
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

class Pessoa implements Animal
{
  public function __construct()
  {
    parent::__construc();
  }

  public function driveTheCar()
  {
    //Código...
  }
}
```

---------------------------------  
</br>

## Fontes:
- https://www.php-fig.org/psr/