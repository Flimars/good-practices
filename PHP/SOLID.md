# Princípios do SOLID

1. **S** ingle Responsability  
2. **O** pen Close  
3. **L** iskov Substituition  
4. **I** nterface segregation  
5. **D** ependency Injection  

> Trechos deste documento foram retirados do artigo [SOLID com PHP](https://imasters.com.br/back-end/solid-com-php#:~:text=SOLID%20s%C3%A3o%20os%20cinco%20principais,com%20exemplos%20escritos%20em%20PHP.) conforme referência ao final da página inicial da documentação.
-------------------------------

## 1. Single Responsability

Muitas vezes o princípio da Responsabilidade Única é falada em relação à funções, porém ela é muito mais abrangente que isso e pode ser aplicada aos três itens abaixo.

### Variáveis

Deve contar apenas com uma responsabilidade;  
Não se cria uma variável genérica como $objeto e instancia classes diferentes nela no mesmo trecho de código.

### Funções

Devem fazer apenas uma ação por chamada do método;  
Se necessário, uma função pode acionar outra função para que uma complemente as ações da outra;  
Uma função jamais deve permitir alterar o tipo de seu retorno com base em um parâmetro *booleano*, isso lhe indica que está com mais de uma responsabilidade.

### Classes

Não deve fazer mais do que seu escopo lhe permite;  
Classes devem possuir apenas um motivo para serem alteradas;  
Gerar inúmeros arquivos com classes que sigam o SRP exige cuidado com a organização do projeto.  
Se uma classe é Controladora, ela tem a responsabilidade de tratar requisições e respostas, porém jamais conter regras de negócio, função essa destinada à classes como a Service, por exemplo.  
Classes Active Record jamais devem possuir implementações de métodos publicos, qualquer acesso à classe deve ser feita por meio de Repositories, mantendo-a fechada para alteração.

```PHP
class TeenageDiary
{
    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate()
        ];
    }
}

class JSONContentFormatter
{
    public function format(TeenageDiary $teenageDiary)
    {
        return json_encode($teenageDiary->getContents());
    }
}
```

-------------------------------

## 2. Open Close

Princípio do Aberto e Fechado.

Este princípio visa garantir que uma classe jamais tenha motivos para ser alterada, apenas estendida.  
Para garantir a aplicação do Aberto/Fechado é necessário a implementação de classes base, que serão estendidas para classes especialistas, dessa forma, sempre que algo novo deve ser implementado é importante que uma nova classe especialista seja criada com o intuito de implementar as novas funcionalidades.  
Dessa forma as classes especialistas podem receber novas funções e sobrecarga ou sobreposição de funções da classe pai sem alterá-la.  

```PHP
class Report
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function write($message)
    {
        $this->writer->write($message);
    }
}

interface Writer
{
    public function write($message);
}

class Doc implements Writer
{
    public function write($message)
    {
        //lógica
    }
}

class Csv implements Writer
{
    public function write($message)
    {
        //lógica
    }
}

//Podemos criar mais quantos formatos de exportação desejarmos aqui ou alterar as existentes.
//Classe Report sempre fechada para edição, mas prático de estender.
```

-------------------------------

## 3. Liskov Substituition

Princípio da Substituição de Liskov.

Uma definição muito simplista deste princípio é:

> "*Uma classe base pode ser substituída por sua classe derivada.*"

Pensando nisso devemos sempre pensar se a decisão de aplicar a herança foi realmente interessante naquele contexto.

> "Se nada como um pato, grasna como um pato, anda como um pato, mas precisa de baterias? Então não é uma Ave."

A ideia é que por mais parecido que seja um objeto do outro, não significa que deva ser aplicado o conceito de Herança, pois haverá muitas modificações em seu comportamento, como a dependência de "gastar baterias" ao realizar suas ações, como andar ou grasnar.  
No exemplo acima, as Classes Pato e PatoEletrico não poderiam ser substituídas uma pela outra sem que o funcionamento da aplicação seja prejudicado.

Para não quebrar o princípio da substituição de Liskov é importante repensar a forma como se aplica Herança.  

```PHP
class Logger
{
    public function writer($message)
    {
        //lógica
    }
}

class DatabaseLogger extends Logger
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function writer($message)
    {
        //lógica
    }
}

class FileLogger extends Logger
{
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function writer($message)
    {
        //lógica
    }
}
```

Nesse exemplo nós temos a classe *Logger*, *DatabaseLogger* e a *FileLogger* o princípio da substituição de Liskov diz que podemos usar tanto a classe *FileLogger* quanto *DatabaseLogger* e a nossa aplicação deve manter o mesmo comportamento, isso vale para qualquer classe que estende da classe *Logger*.  
Reparem que todas possuem exatamente o mesmo número de funções e mesmo tipo de retorno de forma que façam exatamente a mesma coisa para entradas diferentes.

Conforme esse pequeno exemplo, podemos usar todas as classes que vamos atingir o mesmo resultado.

```PHP
$logger = new FileLogger($fileManager);
$logger->write('meu log');

$logger = new DatabaseLogger($database);
$logger->write('meu log');
```

-------------------------------

## 4. Interface segregation

Princípio da Segregação de Interfaces.

O objetivo deste princípio é garantir que nenhuma classe que possua um contrato seja obrigada à implementar um método que não precisa.  
Se mais de uma classe utiliza a mesma interface, porém uma possui uma função à mais que a outra, o correto seria a implementação de interfaces separadas para cada uma.  
Jamais utilize uma interface se isso te obrigar à implementar uma função que não é necessária.  

```PHP
//Interfaces segregadas para cada novo grupo de particularidades.
interface Caes
{
    public function andar();
    public function latir();
    public function comer();
    //...
}

interface CaesViraLata extends Caes
{
    public function autoCura(); //<- Adiciona todos os métodos de Caes + os novos.
}

interface CaesSanguinarios extends Caes
{
    public function perseguicao(); //<- Adiciona todos os métodos de Caes + os novos.
}

//Classes com implementação de interfaces
class Pinscher implements CaesSanguinarios
{
    public function latir()
    {
        //lógica
    }

    public function comer()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }

    public function perseguicao() //<- Aplicada da interface CaesSanguinários
    {
        //lógica
    }
}

class Caramelo implements CaesViraLata
{
    public function latir()
    {
        //lógica
    }

    public function comer()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }

    {
    public function autoCura() //<- Aplicada da interface CaesViraLata
    {
        //lógica
    }
}
```

-------------------------------

## 5. Dependency Inversion

Princípio da Inversão de Dependências.

A injeção de dependências é algo comum na orientação à objetos, com uso de Classes Abstratas ou Interfaces.  
O último princípio do SOLID prevê justamente o uso adequado de interfaces, garantindo que uma classe jamais dependa diretamente de outra e sim de sua interface.  
Dessa forma ao injetar uma dependência, é injetada a sua interface ao invés da classe em si, garantindo que caso qualquer novo método seja implementado ou caso a classe seja refatorada, nada afete seu comportamento.  
Um contexto interessante para pensar sobre a Inversão de Dependência é:

> "*Voce usa óculos e precisa trocar o seu óculos por um novo, esse princípio garante que o novo óculos possua as mesmas características básicas que o antigo, para que ele encaixe perfeitamente no seu rosto e nariz, mesmo que seja de lentes escuras ou com grau maior, sem que seja necessário você mandar o óculos para realizar ajustes nas hastes ou nas plaquetas depois que já o trocou pelo antigo.*"

Utilizando o mesmo exemplo da Segregação de Interfaces, o que demonstra a ligação direta entre os princípios, podemos notar que injetamos a Interface e não a Classe, dessa forma podemos substituir ou implementar quantas novas classes precisarmos sem afetar o funcionamento do código.

```PHP
class Report
{
    private $writer;

    public function __construct(Writer $writer) // <- Injetamos a interface Writer
    {
        $this->writer = $writer;
    }

    public function write($message)
    {
        $this->writer->write($message);
    }
}

interface Writer
{
    public function write($message);
}

class Doc implements Writer
{
    public function write($message)
    {
        //lógica
    }
}

class Csv implements Writer
{
    public function write($message)
    {
        //lógica
    }
}

//Podemos criar mais quantas classes desejarmos aqui ou alterar as existentes.
//Desde que não quebre o contrato, sem afetar o código.

```

-------------------------------

[Início](PHP.md)
