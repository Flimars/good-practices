# Conceitos de Clean Code adaptados para .NET/.NET Core

Escrito em: 29/03/2022

Autor: Michel Vaz Ramos

Adaptado de experiências pessoais e das seguintes fontes:

- [Clean Code .NET](https://github.com/thangchung/clean-code-dotnet#introduction)
- [C# Coding Guidelines](https://csharpcodingguidelines.com/)


# Introdução

> "A única métrica válida para qualidade de código é: wtf/minuto" - (Autor desconhecido)

Esse documento contém **princípios de engenharia de software** retirados do livro [Clean Code de Robert C. Martin](#referências), adaptados para .NET/.NET Core.

**Esteja ciente que:**

1. Nem todos os princípios devem ser estritamente seguidos.
1. Poucos desses princípios são universalmente aceitos.
1. Esses princípios são nada mais além de guias, porém, foram **criados e aprimorados coletivamente através de anos de prática e experiência** pelos autores do livro.

# Por que usar esse guia se ele limita minha criatividade?

Você deve usar esse guia porque nem todo desenvolvedor:

* está ciente de que se lê código 10x mais do que se escreve código.
* está ciente das potenciais armadilhas de certas construções em C#.
* está atualizado sobre certas convensões do .NET Framework, tais como: `IDisposable, async / await` ou a natureza da execução adiada do LINQ.
* está ciente do impacto de usar (ou não usar) soluções específicas em aspectos como segurança, performance, suporte a multi-linguagem, etc.
* percebe que nem todo desenvolvedor é capacitado, habilidoso ou experiente para entender soluções elegantes, porém, potencialmente muito abstratas.

Este guia está subdividido nos tópicos a seguir:

1. [Nomes](#nomes)
1. [Variáveis](#variáveis)
1. [Funções](#funções)
1. [Objetos e Estruturas de Dados](#objetos-e-estrutura-de-dados)
1. [Classes](#classes)
1. [SOLID](#solid)
1. [Tratamento de Exceções](#tratamento-de-erros)
1. [Comentários](#comentários)
1. [Desempenho](#desempenho)

Espero que esse guia seja útil para quem está lendo tanto quanto foi útil para mim enquanto eu escrevia este documento.

# Nomes

## Evite usar nomes ruins

Um bom nome permite que o código seja utilizado por muitos desenvolvedores. O nome deve refletir o propósito e dar contexto.

**Ruim**

```cs
int d = GetDaysSinceModified();
```

**Bom**
```cs
int daySinceModified = GetDaysSinceModified();
```

## Evite nomes que enganam

O nome de uma variável deve refletir para que ela é usada.

**Ruim**

```cs
var dataFromDb = db.GetFromService().ToList();
```

**Bom**

```cs
var listOfEmployee = _employeeService.GetEmployees().ToList();
```

## Evite notação Hungarian (Hungarian Notation)

A notação Hungarian expressa o tipo da variável no nome. É desnecessário em IDE's modernas, pois elas identificam o tipo.

**Ruim**

```cs
int iCounter;
string strFullName;
DateTime dModifiedDate;
```

**Bom**

```cs
int counter;
string fullName;
DateTime modifiedDate;
```

Notação hungarian também não deve ser usada em parâmetros:

**Ruim**

```cs
public bool IsShopOpen(string pDay, int pAmount)
{
    // ...
}
```
**Bom**

```cs
public bool IsShopOpen(string day, int amount)
{
    // ...
}
```

## Use capitalização consistente

A capitalização fala bastante sobre suas variáveis, funções, etc. Essas regras são subjetivas, então o time pode escolher qualquer regra. O ponto é: não interessa qual regra se escolha, seja consistente com essa regra.

**Ruim**

```cs
const int DAYS_IN_WEEK = 7;
const int daysInMonth = 30;

var songs = new List<string> { 'Back In Black', 'Stairway to Heaven', 'Paradise City' };
var Artists = new List<string> { 'ACDC', 'Led Zeppelin', 'Guns and Roses' };

bool EraseDatabase() {}
bool Restore_database() {}

class animal {}
class Alpaca {}
```

**Bom**

```cs
const int DaysInWeek = 7;
const int DaysInMonth = 30;

var songs = new List<string> { 'Back In Black', 'Stairway to Heaven', 'Paradise City' };
var artists = new List<string> { 'ACDC', 'Led Zeppelin', 'Guns and Roses' };

bool EraseDatabase() {}
bool RestoreDatabase() {}

class Animal {}
class Alpaca {}
```

## Use nomes pronunciáveis

Demora um bom tempo para descobrir o significado de variáveis e funções quando o nome não é pronunciável.

**Ruim**

```cs
public class Employee
{
    public Datetime sWorkDate { get; set; } // O que é isso?
    public Datetime modTime { get; set; } // E isso?
}
```

**Bom**

```cs
public class Employee
{
    public Datetime StartWorkingDate { get; set; }
    public Datetime ModificationTime { get; set; }
}
```

## Use a notação Camelcase

Use a notação Camelcase para variáveis e parâmetros em métodos.

**Ruim**

```cs
var employeephone;

public double CalculateSalary(int workingdays, int workinghours)
{
    // ...
}
```

**Bom**

```cs
var employeePhone;

public double CalculateSalary(int workingDays, int workingHours)
{
    // ...
}
```

# Variáveis

## Evite aninhar profundamente e retornar cedo

Quando há muitas declarações if/else aninhadas, o código fica difícil de ler. **Explícito é melhor do que implícito**.

**Ruim**

```cs
public bool IsShopOpen(string day)
{
    if (!string.IsNullOrEmpty(day))
    {
        day = day.ToLower();
        if (day == "friday")
        {
            return true;
        }
        else if (day == "saturday")
        {
            return true;
        }
        else if (day == "sunday")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }

}
```

**Bom**

```cs
public bool IsShopOpen(string day)
{
    if (string.IsNullOrEmpty(day))
    {
        return false;
    }

    var openingDays = new[] { "friday", "saturday", "sunday" };
    return openingDays.Any(d => d == day.ToLower());
}
```

## Evite mapeamento mental

Não force o seu colega que está lendo o código a traduzir o que a variável significa. **Explícito é melhor do que implícito**.

**Ruim**

```cs
var l = new[] { "Austin", "New York", "San Francisco" };

for (var i = 0; i < l.Count(); i++)
{
    var li = l[i];
    DoStuff();
    DoSomeOtherStuff();

    // ...
    // ...
    // ...
    // Espera, o que é mesmo 'li'???
    Dispatch(li);
}
```

**Bom**

```cs
var locations = new[] { "Austin", "New York", "San Francisco" };

foreach (var location in locations)
{
    DoStuff();
    DoSomeOtherStuff();

    // ...
    // ...
    // ...
    Dispatch(location);
}
```

## Evite a string mágica

Strings mágicas são valores string que são especificados diretamente no código e tem impacto no comportamento da aplicação. Frequentemente tais strings serão duplicadas no sistema. Como elas não podem ser automaticamente atualizadas usando ferramentas, elas se tornam fonte de bugs quando são feitas modificações em algumas strings mas não em outras.

**Ruim**

```cs
if (userRole == "Admin")
{
    // ...
}
```

**Bom**

```cs
const string ADMIN_ROLE = "Admin"

if (userRole == ADMIN_ROLE)
{
    // ...
}
```

Da forma acima, somente um local do sistema precisa modificado e o resto do sistema funcionará de acordo.

## Não inclua contexto desnecessário

Se o nome da classe/objeto te diz alguma coisa, não repita isso no nome da variável.

**Ruim**

```cs
public class Car
{
    public string CarMake { get; set; }
    public string CarModel { get; set; }
    public string CarColor { get; set; }

    //...
}
```

**Bom**

```cs
public class Car
{
    public string Make { get; set; }
    public string Model { get; set; }
    public string Color { get; set; }

    //...
}
```

## Use nomes de variáveis pronunciáveis e com significado

**Ruim**

```cs
var ymdstr = DateTime.UtcNow.ToString("MMMM dd, yyyy");
```

**Bom**

```cs
var currentDate = DateTime.UtcNow.ToString("MMMM dd, yyyy");
```

## Use o mesmo vocabulário para o mesmo tipo de variável

**Ruim**

```cs
var user = service1.GetUserInfo();
var user = service2.GetUserData();
var user = service3.GetUserRecord();
var user = service4.GetUserProfile();
```

**Bom**

```cs
var user = serviceN.GetUser();
```

## Use nomes que possam ser encontrados na busca (parte 1)

Iremos ler mais código do que escrever em toda a nossa carreira. É importante que o código seja legível e buscável. Quando não nomeamos nossas variáveis com nomes significativos, acabamos por lesar quem está lendo. Faça com que os nomes de variáveis sejam buscáveis.

**Ruim**

```cs
// Para que serve a variável data?
var data = new { Name = "John", Age = 42 };

var stream1 = new MemoryStream();
var ser1 = new DataContractJsonSerializer(typeof(object));
ser1.WriteObject(stream1, data);

stream1.Position = 0;
var sr1 = new StreamReader(stream1);
Console.Write("JSON form of Data object: ");
Console.WriteLine(sr1.ReadToEnd());
```

**Bom**

```cs
var person = new Person
{
    Name = "John",
    Age = 42
};

var stream2 = new MemoryStream();
var ser2 = new DataContractJsonSerializer(typeof(Person));
ser2.WriteObject(stream2, data);

stream2.Position = 0;
var sr2 = new StreamReader(stream2);
Console.Write("JSON form of Data object: ");
Console.WriteLine(sr2.ReadToEnd());
```
## Use nomes que possam ser encontrados na busca (parte 2)

**Ruim**

```cs
var data = new { 
    Name = "John", 
    Age = 42, 
    PersonAccess = 4
    };

// Para que serve o 4?
if (data.PersonAccess == 4)
{
    // editar ...
}
```

**Bom**

```cs
public enum PersonAccess : int
{
    ACCESS_READ = 1,
    ACCESS_CREATE = 2,
    ACCESS_UPDATE = 4,
    ACCESS_DELETE = 8
}

var person = new Person
{
    Name = "John",
    Age = 42,
    PersonAccess= PersonAccess.ACCESS_CREATE
};

if (person.PersonAccess == PersonAccess.ACCESS_UPDATE)
{
    // editar ...
}
```

## Use argumentos padrão em vez de lógica

**Ruim**

```cs
public void CreateMicrobrewery(string name = null)
{
    var breweryName = !string.IsNullOrEmpty(name) ? name : "Hipster Brew Co.";
    // ...
}
```

**Bom**

```cs
public void CreateMicrobrewery(string breweryName = "Hipster Brew Co.")
{
    // ...
}
```

# Funções

## Evite efeitos colaterais

Uma função tem efeitos colaterais se ela faz alguma coisa além de receber um valor (ou valores) e retornar um valor (ou valores). Por exemplo, elas podem acidentalmente: modificar uma variável global, escrever em um arquivo, entregar todo o teu dinheiro para um estranho.

Ocasionalmente é necessário ter efeitos colaterais: você pode precisar escrever em um arquivo. O que você precisa fazer é centralizar onde você está fazendo este trabalho. Não tenha várias funções e classes escrevendo em um arquivo. Tenha um serviço que faça isso, e **somente um**.

O objetivo é evitar problemas comuns, como compartilhar estado entre objetos sem estrutura, usar dados mutáveis que pode ser escritos por qualquer classe/método e não centralizar o local onde os efeitos colaterais podem ocorrer.

**Ruim**

```cs
// Variável global referenciada pela função a seguir.
// Se tivéssemos outra função que usa a variável name, agora ela seria um array e o programa iria parar.
var name = "Ryan McDermott";

public void SplitAndEnrichFullName()
{
    var temp = name.Split(" ");
    name = $"Primeiro nome é {temp[0]}, e sobrenome é {temp[1]}"; // efeito colateral
}

SplitAndEnrichFullName();

Console.WriteLine(name); // Primeiro nome é Ryan, e sobrenome é McDermott
```

**Bom**

```cs
public string SplitAndEnrichFullName(string name)
{
    var temp = name.Split(" ");
    return $"Primeiro nome é {temp[0]}, e sobrenome é {temp[1]}";
}

var name = "Ryan McDermott";
var fullName = SplitAndEnrichFullName(name);

Console.WriteLine(name); // Ryan McDermott
Console.WriteLine(fullName); //  Primeiro nome é Ryan, e sobrenome é McDermott
```

## Evite condicionais negativas

**Ruim**

```cs
public bool IsNodeNotPresent(string node)
{
    // ...
}

if (!IsNodeNotPresent(node))
{
    // ...
}
```

**Bom**

```cs
public bool IsNodePresent(string node)
{
    // ...
}

if (IsNodePresent(node))
{
    // ...
}
```

## Evite condicionais

Essa parece ser uma tarefa impossível. A primeira vez que se ouve isso, geralmente o programador diz:

> "como vou programar qualquer coisa sem usar `if`?"

A resposta é: você pode usar polimorfismo para obter o mesmo resultado em muitas tarefas. A segunda frase do desenvolvedor é:

> Legal, mas por que eu iria querer fazer isso?

A resposta é um conceito já visto sobre Clean Code: uma função deve fazer uma coisa, e somente uma. Quando classes e funções contém declarações `if`, você está dizendo a quem usa que sua função faz mais de uma coisa.

**Ruim**

```cs
class Airplane
{
    // ...

    public double GetCruisingAltitude()
    {
        switch (_type)
        {
            case '777':
                return GetMaxAltitude() - GetPassengerCount();
            case 'Air Force One':
                return GetMaxAltitude();
            case 'Cessna':
                return GetMaxAltitude() - GetFuelExpenditure();
        }
    }
}
```

**Bom**

```cs
interface IAirplane
{
    // ...
    double GetCruisingAltitude();
}

class Boeing777 : IAirplane
{
    // ...
    public double GetCruisingAltitude()
    {
        return GetMaxAltitude() - GetPassengerCount();
    }
}

class AirForceOne : IAirplane
{
    // ...
    public double GetCruisingAltitude()
    {
        return GetMaxAltitude();
    }
}

class Cessna : IAirplane
{
    // ...
    public double GetCruisingAltitude()
    {
        return GetMaxAltitude() - GetFuelExpenditure();
    }
}
```

## Evite pré-verificação de tipo (parte 1)

**Ruim**

```cs
public Path TravelToTexas(object vehicle)
{
    if (vehicle.GetType() == typeof(Bicycle))
    {
        (vehicle as Bicycle).PeddleTo(new Location("texas"));
    }
    else if (vehicle.GetType() == typeof(Car))
    {
        (vehicle as Car).DriveTo(new Location("texas"));
    }
}
```

**Bom**

```cs
public Path TravelToTexas(Traveler vehicle)
{
    vehicle.TravelTo(new Location("texas"));
}

// ou então...

// pattern matching
public Path TravelToTexas(object vehicle)
{
    if (vehicle is Bicycle bicycle)
    {
        bicycle.PeddleTo(new Location("texas"));
    }
    else if (vehicle is Car car)
    {
        car.DriveTo(new Location("texas"));
    }
}
```

## Evite verificação de tipo (parte 2)

**Ruim**

```cs
public int Combine(dynamic val1, dynamic val2)
{
    int value;
    if (!int.TryParse(val1, out value) || !int.TryParse(val2, out value))
    {
        throw new Exception('Deve ser um tipo numérico');
    }

    return val1 + val2;
}
```

**Bom**

```cs
public int Combine(int val1, int val2)
{
    return val1 + val2;
}
```

## Evite o uso de flags em parâmetros de métodos

Uma flag pode indicar que um método possui mais de uma responsabilidade. É melhor que ele possua apenas uma reponsabilidade. Divida o método em dois se um boleano faz com que o método possua duas responsabilidades.

**Ruim**

```cs
public void CreateFile(string name, bool temp = false)
{
    if (temp)
    {
        Touch("./temp/" + name);
    }
    else
    {
        Touch(name);
    }
}
```

**Bom**

```cs
public void CreateFile(string name)
{
    Touch(name);
}

public void CreateTempFile(string name)
{
    Touch("./temp/"  + name);
}
```

## Não escreva funções globais

Sobrecarregar e poluir globais é uma má prática em muitas linguagens. Pode haver conflitos com outras bibliotecas e o usuário do código não estaria ciente até ter uma exceção em produção. Pense no seguinte: você escreve uma função global `Config()`, mas ela pode conflitar com outra biblioteca que tentar fazer a mesma coisa.

**Ruim**

```cs
public Dictionary<string, string> Config()
{
    return new Dictionary<string,string>(){
        ["foo"] = "bar"
    };
}
```

**Bom**

```cs
class Configuration
{
    private Dictionary<string, string> _configuration;

    public Configuration(Dictionary<string, string> configuration)
    {
        _configuration = configuration;
    }

    public string[] Get(string key)
    {
        return _configuration.ContainsKey(key) ? _configuration[key] : null;
    }
}
```

## Não use o padrão Singleton

Singleton é um anti-padrão. Parafraseando Brian Burton:

> 1. Geralmente são utilizados como instância global. Por que é tão ruim? Porque você **esconde as dependências** da sua aplicação no código em vez de expô-las através de uma interface. Fazer algo ser global em vez de expor em uma interface é um "code smell".
>
> 1. Violam o **princípio da responsabilidade única**: pelo fato de eles **controlarem sua própria criação e ciclo de vida**.
>
> 1. De forma inerente causam alto acoplamento. O alto acoplamento faz com que os testes sejam difíceis, pois é difícil de fazer uma classe que finge ser ela para testes.
>
> 1. Carregam seu estado por todo o ciclo de vida do sistema e isso é mais uma dica para os problemas na hora do teste: você pode terminar em uma situação em que os testes precisam ter uma ordem específica, o que é um grande "não" se tratando de testes unitários. Por quê? Porque todo teste unitário deve ser independente um do outro.

**Ruim**

```cs
class DBConnection
{
    private static DBConnection _instance;

    private DBConnection()
    {
        // ...
    }

    public static GetInstance()
    {
        if (_instance == null)
        {
            _instance = new DBConnection();
        }

        return _instance;
    }

    // ...
}

var singleton = DBConnection.GetInstance();
```

**Bom**

```cs
class DBConnection
{
    public DBConnection(IOptions<DbConnectionOption> options)
    {
        // ...
    }

    // ...
}
//Cria uma instância da classe DBConnection e configura usando o padrão Option.

var options = <resolve from IOC>;
var connection = new DBConnection(options);
```

E agora você deve ter uma instância de `DBConnection` na aplicação.

## Argumentos de função (2 ou menos, idealmente)

Limitar o número de parâmetros em funções é incrivelmente importante porque faz com que os testes fiquem mais fáceis. Tendo mais de três parâmetros leva a uma explosão combinatória onde se deve testar muitos e muitos casos com cada argumento separadamente.

Zero argumentos é o ideal. Um ou dois argumentos é ok e três deve ser evitado. Geralmente, quando se tem mais de dois argumentos é porque a sua função está fazendo muito trabalho. Nos casos em que ela não está, a maioria das vezes um objeto de alto nível é suficiente como argumento.

**Ruim**

```cs
public void CreateMenu(string title, string body, string buttonText, bool cancellable)
{
    // ...
}
```

**Bom**

```cs
public class MenuConfig
{
    public string Title { get; set; }
    public string Body { get; set; }
    public string ButtonText { get; set; }
    public bool Cancellable { get; set; }
}

var config = new MenuConfig
{
    Title = "Foo",
    Body = "Bar",
    ButtonText = "Baz",
    Cancellable = true
};

public void CreateMenu(MenuConfig config)
{
    // ...
}
```

## Funções devem fazer somente uma coisa

Essa é, de longe, a regra mais importante da engenharia de software. Quando funções fazem mais de uma coisa, elas são difíceis de escrever, testar e raciocinar sobre. Quando você consegue isolar uma função a somente uma ação, ela pode ser refatorada facilmente e a leitura do seu código será muito mais fácil. Se você levar consigo nada mais desse guia além disso, você já estará à frente de muitos desenvolvedores.

**Ruim**

```cs
public void SendEmailToListOfClients(string[] clients)
{
    foreach (var client in clients)
    {
        var clientRecord = db.Find(client);
        if (clientRecord.IsActive())
        {
            Email(client);
        }
    }
}
```

**Bom**

```cs
public void SendEmailToListOfClients(string[] clients)
{
    var activeClients = GetActiveClients(clients);
    // ...
}

public List<Client> GetActiveClients(string[] clients)
{
    return db.Find(clients).Where(s => s.Status == "Active");
}
```

## Nome de função deve dizer o que ela faz

**Ruim**

```cs
public class Email
{
    // ...
    public void Handle()
    {
        SendMail(this._to, this._subject, this._body);
    }
}

var message = new Email(...);
// O que é isso? Uma handle para a message? Estamos salvando em um arquivo?
message.Handle();
```

**Bom**

```cs
public class Email
{
    //...

    public void Send()
    {
        SendMail(this._to, this._subject, this._body);
    }
}

var message = new Email(...);
// Claro e óbvio
message.Send();
```

## O chamador da função e chamados pela função devem ser próximos

Se uma função chama outra, mantenha essas funções verticalmente próximas no código-fonte, de preferência a função chamada abaixo da função chamadora. Faça seu código ser lido como um jornal (de cima para baixo).

**Ruim**

```cs
class PerformanceReview
{
    private readonly Employee _employee;

    public PerformanceReview(Employee employee)
    {
        _employee = employee;
    }

    private IEnumerable<PeersData> LookupPeers()
    {
        return db.lookup(_employee, 'peers');
    }

    private ManagerData LookupManager()
    {
        return db.lookup(_employee, 'manager');
    }

    private IEnumerable<PeerReviews> GetPeerReviews()
    {
        var peers = LookupPeers();
        // ...
    }

    public PerfReviewData PerfReview()
    {
        GetPeerReviews();
        GetManagerReview();
        GetSelfReview();
    }

    public ManagerData GetManagerReview()
    {
        var manager = LookupManager();
    }

    public EmployeeData GetSelfReview()
    {
        // ...
    }
}

var  review = new PerformanceReview(employee);
review.PerfReview();
```

**Bom**

```cs
class PerformanceReview
{
    private readonly Employee _employee;

    public PerformanceReview(Employee employee)
    {
        _employee = employee;
    }

    public PerfReviewData PerfReview()
    {
        GetPeerReviews();
        GetManagerReview();
        GetSelfReview();
    }

    private IEnumerable<PeerReviews> GetPeerReviews()
    {
        var peers = LookupPeers();
        // ...
    }

    private IEnumerable<PeersData> LookupPeers()
    {
        return db.lookup(_employee, 'peers');
    }

    private ManagerData GetManagerReview()
    {
        var manager = LookupManager();
        return manager;
    }

    private ManagerData LookupManager()
    {
        return db.lookup(_employee, 'manager');
    }

    private EmployeeData GetSelfReview()
    {
        // ...
    }
}

var review = new PerformanceReview(employee);
review.PerfReview();
```

## Encapsule condicionais

**Ruim**

```cs
if (article.state == "published")
{
    // ...
}
```

**Bom**

```cs
if (article.IsPublished())
{
    // ...
}
```

## Remova código morto

Código morto é tão ruim quanto código duplicado. Não há motivo para mantê-lo no código-fonte. Se não está sendo usado, jogue-o fora. Ele estará seguro no histórico de versões caso ele seja necessário.

**Ruim**

```cs
public void OldRequestModule(string url)
{
    // ...
}

public void NewRequestModule(string url)
{
    // ...
}

var request = NewRequestModule(requestUrl);
InventoryTracker("apples", request, "www.inventory-awesome.io");
```

**Bom**

```cs
public void RequestModule(string url)
{
    // ...
}

var request = RequestModule(requestUrl);
InventoryTracker("apples", request, "www.inventory-awesome.io");
```

# Objetos e estrutura de dados

## Use getters e setters

Em C# use as palavras chave `public`, `protected` e `private` em métodos. Assim, você pode controlar a modificação de propriedades de um objeto.

Vantagens:

1. Quando você quer fazer mais do que simplesmente obter uma propriedade, não será necessário modificar o fonte em vários locais diferentes.
1. É mais fácil de adicionar validação quando usar `set`.
1. Encapsula a representação interna.
1. Mais fácil de fazer log e adicionar tratamento e erros quando se usa `get` e `set`.
1. Ao herdar desta classe é possível sobrepor o comportamento padrão desse objeto.
1. Pode-se aplicar o padrão Lazy Loading nas propriedades desse objeto, por exemplo, quando se busca ele de um servidor.

Além disso, é parte do princípio Aberto/Fechado da orientação à objetos:

- **aberto** para extensão
- **fechado** para modificação

**Ruim**

```cs
class BankAccount
{
    public double Balance = 1000;
}

var bankAccount = new BankAccount();

// Falso comprar tênis...
bankAccount.Balance -= 100;
```

**Bom**

```cs
class BankAccount
{
    private double _balance = 0.0D;

    pubic double Balance {
        get {
            return _balance;
        }
    }

    public BankAccount(balance = 1000)
    {
       _balance = balance;
    }

    public void WithdrawBalance(int amount)
    {
        if (amount > _balance)
        {
            throw new Exception('Amount greater than available balance.');
        }

        _balance -= amount;
    }

    public void DepositBalance(int amount)
    {
        _balance += amount;
    }
}

var bankAccount = new BankAccount();

// Comprar tênis...
bankAccount.WithdrawBalance(price);

// Obter saldo
balance = bankAccount.Balance;
```

## Faça objetos terem métodos `private`/`protected`

**Ruim**

```cs
class Employee
{
    public string Name { get; set; }

    public Employee(string name)
    {
        Name = name;
    }
}

var employee = new Employee("John Doe");
Console.WriteLine(employee.Name); // Nome do funcionário: John Doe
```

**Bom**

```cs
class Employee
{
    public string Name { get; }

    public Employee(string name)
    {
        Name = name;
    }
}

var employee = new Employee("John Doe");
Console.WriteLine(employee.Name); // Nome do funcionário: John Doe
```

# Classes

## Use encadeamento de métodos

Esse padrão é muito útil e é comum encontrarmos ele em bibliotecas. Ele permite que o código seja expressivo e menos verboso. Por essa razão, use encadeamento de métodos e veja como o seu código fica limpo.

**Ruim**

```cs
var list = new List<int>() { 1, 2, 3, 4, 5 };
list.Add(1);
list.Insert(0, 0);
list.RemoveAt(1);
list.Reverse();
list.ForEach(value => value.WriteLine());
list.Clear();
```

**Bom**

```cs
public static class ListExtensions
{
    public static List<T> FluentAdd<T>(this List<T> list, T item)
    {
        list.Add(item);
        return list;
    }

    public static List<T> FluentClear<T>(this List<T> list)
    {
        list.Clear();
        return list;
    }

    public static List<T> FluentForEach<T>(this List<T> list, Action<T> action)
    {
        list.ForEach(action);
        return list;
    }

    public static List<T> FluentInsert<T>(this List<T> list, int index, T item)
    {
        list.Insert(index, item);
        return list;
    }

    public static List<T> FluentRemoveAt<T>(this List<T> list, int index)
    {
        list.RemoveAt(index);
        return list;
    }

    public static List<T> FluentReverse<T>(this List<T> list)
    {
        list.Reverse();
        return list;
    }
}

internal static void ListFluentExtensions()
{
    var list = new List<int>() { 1, 2, 3, 4, 5 }
        .FluentAdd(1)
        .FluentInsert(0, 0)
        .FluentRemoveAt(1)
        .FluentReverse()
        .FluentForEach(value => value.WriteLine())
        .FluentClear();
}
```

## Prefira composição em vez de herança

Conforme dito no famoso livro _Design Patterns_ escrito pela Gang of Four, onde for possível você deve preferir composição em vez de herança. Existem boas razões para usar herança e boas razões para usar composição.

O ponto principal desta máxima é que quando instintivamente você escolhe herança, pense duas vezes e analise se composição faria a modelagem do seu problema melhor. Às vezes, é possível.

Abaixo uma lista simples e não exaustiva  de **SUGESTÕES** de quando se deve usar herança:

1. Quando a herança representa uma relação "é-um" e não "possui-um" (humano->animal vs Usuario->DadosDoUsuario).
1. Quando se pode reusar código da classe base (humanos podem ser mover, como animais).
1. Quando se quer fazer modificações globais em classes derivadas modificando apenas a classe base (modificar o gasto calórico de animais quando eles se movem).

**Ruim**

```cs
class Employee
{
    private string Name { get; set; }
    private string Email { get; set; }

    public Employee(string name, string email)
    {
        Name = name;
        Email = email;
    }

    // ...
}

// Ruim, pois empregado "possui" dados de imposto.
// EmployeeTaxData não é um tipo de empregado.

class EmployeeTaxData : Employee
{
    private string Name { get; }
    private string Email { get; }

    public EmployeeTaxData(string name, string email, string ssn, string salary)
    {
         // ...
    }
    // ...
}
```

**Bom**

```cs
class EmployeeTaxData
{
    public string Ssn { get; }
    public string Salary { get; }

    public EmployeeTaxData(string ssn, string salary)
    {
        Ssn = ssn;
        Salary = salary;
    }
    // ...
}

class Employee
{
    public string Name { get; }
    public string Email { get; }
    public EmployeeTaxData TaxData { get; }

    public Employee(string name, string email)
    {
        Name = name;
        Email = email;
    }

    public void SetTax(string ssn, double salary)
    {
        TaxData = new EmployeeTaxData(ssn, salary);
    }
    // ...
}
```

# SOLID

## O que é SOLID?

**SOLID** é um acrônimo mnemônico  apresentado por Michael Feathers para os primeiros cinco princípios nomeados por Robert Martin, o que significa, os 5 princípios básicos da programação e projeto orientado à objetos.

- S: Single Responsibility Principle
- O: Open/Closed Principle
- L: Liskov Substituition Principle
- I: Interface Segregation Principle
- D: Dependency Inversion Principle

## S: Princípio da Responsabilidade Uníca

Como o declarado no Clean Code, "nunca deve haver mais de um motivo para uma classe mudar". É tentador entulhar uma classe de funcionalidades, como quando vamos viajar levando apenas uma mala. O problema é que a classe não será coesa conceitualmente e ela lhe dará vários motivos para mudanças. Minimizar o tempo que se leva para modificar uma classe é importante.

**Ruim**

```cs
class UserSettings
{
    private User User;

    public UserSettings(User user)
    {
        User = user;
    }

    public void ChangeSettings(Settings settings)
    {
        if (verifyCredentials())
        {
            // ...
        }
    }

    private bool VerifyCredentials()
    {
        // ...
    }
}
```

**Bom**

```cs
class UserAuth
{
    private User User;

    public UserAuth(User user)
    {
        User = user;
    }

    public bool VerifyCredentials()
    {
        // ...
    }
}

class UserSettings
{
    private User User;
    private UserAuth Auth;

    public UserSettings(User user)
    {
        User = user;
        Auth = new UserAuth(user);
    }

    public void ChangeSettings(Settings settings)
    {
        if (Auth.VerifyCredentials())
        {
            // ...
        }
    }
}
```

## O: Princípio Aberto/Fechado

Conforme declarado por Bertrand Meyer:
> Entidades de software (classes, módulos, funções, etc.) devem ser abertas para extensão, mas fechadas para modificação.

Mas o que isso significa? Basicamente, esse princípio diz que você deve permitir que os usuários (do código) adicionem funcionalidades sem modificar o código existente.

**Ruim**

```cs
abstract class AdapterBase
{
    protected string Name;

    public string GetName()
    {
        return Name;
    }
}

class AjaxAdapter : AdapterBase
{
    public AjaxAdapter()
    {
        Name = "ajaxAdapter";
    }
}

class NodeAdapter : AdapterBase
{
    public NodeAdapter()
    {
        Name = "nodeAdapter";
    }
}

class HttpRequester : AdapterBase
{
    private readonly AdapterBase Adapter;

    public HttpRequester(AdapterBase adapter)
    {
        Adapter = adapter;
    }

    public bool Fetch(string url)
    {
        var adapterName = Adapter.GetName();

        if (adapterName == "ajaxAdapter")
        {
            return MakeAjaxCall(url);
        }
        else if (adapterName == "httpNodeAdapter")
        {
            return MakeHttpCall(url);
        }
    }

    private bool MakeAjaxCall(string url)
    {
        // solicita e retorna uma promise
    }

    private bool MakeHttpCall(string url)
    {
        // solicita e retorna uma promise
    }
}
```

**Bom**

```cs
interface IAdapter
{
    bool Request(string url);
}

class AjaxAdapter : IAdapter
{
    public bool Request(string url)
    {
        // solicita e retorna uma promise
    }
}

class NodeAdapter : IAdapter
{
    public bool Request(string url)
    {
        // solicita e retorna uma promise
    }
}

class HttpRequester
{
    private readonly IAdapter Adapter;

    public HttpRequester(IAdapter adapter)
    {
        Adapter = adapter;
    }

    public bool Fetch(string url)
    {
        return Adapter.Request(url);
    }
}
```

## L: Princípio de Substituição de Liskov

Esse é um termo assustador para um conceito bem simples. Ele é definido formalmente por:

*Se S é um subtipo de T, então objetos do tipo T podem ser substituídos por objetos do tipo S sem que isso altere qualquer propriedade desejável do programa (corretude, tarefa executada, etc.).*

A definição é mais assustadora ainda.

A melhor explicação para isso é: se você tem uma classe base e uma classe derivada, então a classe base e a derivada podem ser usadas de forma intercambiável sem obter resultados incorretos. Isso pode parecer confuso, então vamos olhar o exemplo clássico do quadrado-retângulo. Matematicamente o quadrado é um retângulo, mas se você modela usando um relacionamento "é-um" por herança, então temos imediatamente um problema.

**Ruim**

```cs
class Rectangle
{
    protected double Width = 0;
    protected double Height = 0;

    public Drawable Render(double area)
    {
        // ...
    }

    public void SetWidth(double width)
    {
        Width = width;
    }

    public void SetHeight(double height)
    {
        Height = height;
    }

    public double GetArea()
    {
        return Width * Height;
    }
}

class Square : Rectangle
{
    public double SetWidth(double width)
    {
        Width = Height = width;
    }

    public double SetHeight(double height)
    {
        Width = Height = height;
    }
}

Drawable RenderLargeRectangles(Rectangle rectangles)
{
    foreach (rectangle in rectangles)
    {
        rectangle.SetWidth(4);
        rectangle.SetHeight(5);
        var area = rectangle.GetArea(); // Ruim: retornará 25 para o quadrado. Deveria ser 20.
        rectangle.Render(area);
    }
}

var rectangles = new[] { new Rectangle(), new Rectangle(), new Square() };
RenderLargeRectangles(rectangles);
```

**Bom**

```cs
abstract class ShapeBase
{
    protected double Width = 0;
    protected double Height = 0;

    abstract public double GetArea();

    public Drawable Render(double area)
    {
        // ...
    }
}

class Rectangle : ShapeBase
{
    public void SetWidth(double width)
    {
        Width = width;
    }

    public void SetHeight(double height)
    {
        Height = height;
    }

    public double GetArea()
    {
        return Width * Height;
    }
}

class Square : ShapeBase
{
    private double Length = 0;

    public double SetLength(double length)
    {
        Length = length;
    }

    public double GetArea()
    {
        return Math.Pow(Length, 2);
    }
}

Drawable RenderLargeRectangles(Rectangle rectangles)
{
    foreach (rectangle in rectangles)
    {
        if (rectangle is Square)
        {
            rectangle.SetLength(5);
        }
        else if (rectangle is Rectangle)
        {
            rectangle.SetWidth(4);
            rectangle.SetHeight(5);
        }

        var area = rectangle.GetArea();
        rectangle.Render(area);
    }
}

var shapes = new[] { new Rectangle(), new Rectangle(), new Square() };
RenderLargeRectangles(shapes);
```
## I: Princípio da Separação em interfaces

O princípio da separação em interfaces declara que:
> Clientes não devem ser forçados a depender de uma interface que eles não usam.

Um bom exemplo de que demonstra esse princípio é para classes que necessitam uma quantidade grande de objetos de configuração. É benéfico que o cliente não precise configurar um monte de opções, pois na maioria das vezes não são necessárias todas as configurações. Fazer com que elas sejam opcionais previne ter uma interface muito grande.

**Ruim**

```cs
public interface IEmployee
{
    void Work();
    void Eat();
}

public class Human : IEmployee
{
    public void Work()
    {
        // trabalhando...
    }

    public void Eat()
    {
        // comendo no intervalo...
    }
}

public class Robot : IEmployee
{
    public void Work()
    {
        //trabalhando muito mais
    }

    public void Eat()
    {
        //Robôs não comem, mas sou obrigado a implementar este método
    }
}
```

**Bom**

Nem todo trabalhador é empregado, mas todo empregado é trabalhador.

```cs
public interface IWorkable
{
    void Work();
}

public interface IFeedable
{
    void Eat();
}

public interface IEmployee : IFeedable, IWorkable
{
}

public class Human : IEmployee
{
    public void Work()
    {
        // trabalhando...
    }

    public void Eat()
    {
        //Comendo no intervalo
    }
}

// robôs somente trabalham
public class Robot : IWorkable
{
    public void Work()
    {
        //trabalhando...
    }
}
```

## D: Princípio de Inversão de Dependência

Esse princípio declara duas coisas essenciais:

1. Módulos de alto nível não devem depender de módulos de baixo nível.
1. Abstrações não devem depender de detalhes. Detalhes devem depender de abstrações.

A princípio, pode parecer difícil de entender, mas se você já trabalhou com .NET/.NET Core, você já viu a implementação desse princípio na forma de Injeção de Dependência. Embora não sejam conceitos idênticos, a Inversão de Dependência evita que módulos de alto nível saibam detalhes de módulos de baixo nível ou de como configurá-los e isso pode ser alcançado com Injeção de Dependência. Além disso, conseguimos evitar o acoplamento de módulos, visto que alto acoplamento é um mau hábito de desenvolvimento porque dificulta a refatoração de código.

**Ruim**

```cs
public abstract class EmployeeBase
{
    protected virtual void Work()
    {
        // trabalhando...
    }
}

public class Human : EmployeeBase
{
    public override void Work()
    {
        //trabalhando mais...
    }
}

public class Robot : EmployeeBase
{
    public override void Work()
    {
        //trabalhando muito mais...
    }
}

public class Manager
{
    private readonly Robot _robot;
    private readonly Human _human;

    public Manager(Robot robot, Human human)
    {
        _robot = robot;
        _human = human;
    }

    public void Manage()
    {
        _robot.Work();
        _human.Work();
    }
}
```

**Bom**

```cs
public interface IEmployee
{
    void Work();
}

public class Human : IEmployee
{
    public void Work()
    {
        // trabalhando...
    }
}

public class Robot : IEmployee
{
    public void Work()
    {
        //trabalhando mais...
    }
}

public class Manager
{
    private readonly IEnumerable<IEmployee> _employees;

    public Manager(IEnumerable<IEmployee> employees)
    {
        _employees = employees;
    }

    public void Manage()
    {
        foreach (var employee in _employees)
        {
            _employee.Work();
        }
    }
}
```

## D: Não se repita

Faça o seu melhor para evitar código duplicado. Código duplicado é ruim porque significa que existe mais de um lugar para alterar alguma coisa se você precisa modificar alguma lógica.

Às vezes temos código duplicado porque precisamos fazer duas coisas ligeiramente diferentes, mas que compartilham um monte em comum, mas as diferenças te forçam a ter duas ou mais funções separadas que fazem um monte da mesma coisa. Remover código duplicado significa criar uma abstração que possa lidar com essas diferenças com apenas uma função/classe/módulo.

Acertar na abstração é crítico e, por isso, você deve seguir os conceitos do SOLID explicados na seção **Classes**. Má abstração pode levar a mais código duplicado.

**Ruim**

```cs
public List<EmployeeData> ShowDeveloperList(Developers developers)
{
    foreach (var developers in developer)
    {
        var expectedSalary = developer.CalculateExpectedSalary();
        var experience = developer.GetExperience();
        var githubLink = developer.GetGithubLink();
        var data = new[] {
            expectedSalary,
            experience,
            githubLink
        };

        Render(data);
    }
}

public List<ManagerData> ShowManagerList(Manager managers)
{
    foreach (var manager in managers)
    {
        var expectedSalary = manager.CalculateExpectedSalary();
        var experience = manager.GetExperience();
        var githubLink = manager.GetGithubLink();
        var data =
        new[] {
            expectedSalary,
            experience,
            githubLink
        };

        render(data);
    }
}
```

**Bom**

```cs
public List<EmployeeData> ShowList(Employee employees)
{
    foreach (var employee in employees)
    {
        var expectedSalary = employees.CalculateExpectedSalary();
        var experience = employees.GetExperience();
        var githubLink = employees.GetGithubLink();
        var data =
        new[] {
            expectedSalary,
            experience,
            githubLink
        };

        render(data);
    }
}
```

**Muito bom**

```cs
public List<EmployeeData> ShowList(Employee employees)
{
    foreach (var employee in employees)
    {
        render(new[] {
            employee.CalculateExpectedSalary(),
            employee.GetExperience(),
            employee.GetGithubLink()
        });
    }
}
```



# Tratamento de erros

## Afinal, o que é exceção?

Em termos de linguagens de programação, uma exceção é um desvio condicional, exatamente como `if/else,switch/case`, com o diferencial que ela carrega consigo a pilha de execução. No C#, quando uma exceção é disparada, o método atual é interrompido e a execução continua no ponto onde o método foi chamado. Se o ponto onde o método for chamado não estiver dentro de um bloco `try/catch`, então o método é interrompido e retorna para o ponto onde foi chamado, e assim sucessivamente até que seja encontrado um bloco `try/catch`. Se chegarmos no topo da árvore de chamadas e não houver tratamento de exceção, o programa é terminado.


## Quando disparar exceção?

Resposta: quando não for possível continuar a partir do ponto atual no código, seja porque um serviço não está disponível, uma falha na leitura de um arquivo, um parâmetro de entrada inválido na função, etc. Pense no seguinte: a regra é que o método deve executar até o final com as informações que ele possui. Se ele não pode executar até o final, isso é uma exceção, afinal, você não pode enviar um e-mail sem o endereço do destinatário, por exemplo. Resumo: sempre que a função/método não for capaz de cumprir a sua tarefa, dispare uma exceção.

**Ruim**

```cs
Person UpdatePersonEmail(int personId, string emailAddress){    
    Person person = db.person.find(personId);

    if(person == null){
        return null;
    }

    person.email = emailAdress;
    db.person.Update(person);

    return person;
}

person = UpdatePersonEmail(-1,"michel.ramos@deliverit.com.br");
//agora pessoa é null
```

**Bom**

```cs
Person UpdatePersonEmail( int personId, string emailAddress) {    
    Person person = db.person.find(personId);

    if( person == null ) {
        throw new Exception("Pessoa não encontrada.");
    }

    person.email = emailAdress;
    db.person.Update(person);

    return person;
}

try 
{
    person = UpdatePersonEmail(-1,"michel.ramos@deliverit.com.br");
} catch (Exception ex) {
    //executar limpeza e sair do método...
    //ou continuar sem enviar e-mail...
}

```

## Não use `throw ex` no bloco `catch`

Se você precisar disparar a mesma exceção, apena use `throw`. Dessa forma a pilha de execução será preservada, caso contrário, será perdida.

**Ruim**

```cs
try
{
    // Faça alguma coisa...
}
catch (Exception ex)
{
    // Qualquer ação, como desfazer alterações, fazer log.
    throw ex;
}
```

**Pior**

```cs
try
{
    // Faça alguma coisa...
}
catch (Exception ex)
{
    // Qualquer ação, como desfazer alterações, fazer log.
    throw new Exception(ex.Message);
}
```

**Bom**

```cs
try
{
    // Faça alguma coisa...
}
catch (Exception ex)
{
   // Qualquer ação, como desfazer alterações, fazer log.
    throw;
}
```

## Não ignore erros pegos

Fazer nada com um erro pego não lhe dá a habilidade de corrigir ou reagir a um erro. Relançar uma exceção não é muito melhor do que isso, pois pode se perder em meio a uma enxurrada de mensagens no console. Se você coloca um código dentro do `try/catch`, isso significa que você acha que uma exceção pode ser disparada e você deve ter um plano ou um caminho alternativo no código para isso.

**Ruim**

```cs
try
{
    FunctionThatMightThrow();
}
catch (Exception ex)
{
    // erro silencioso
}
```

**Bom**

```cs
try
{
    FunctionThatMightThrow();
}
catch (Exception error)
{
    NotifyUserOfError(error);

    // Outra opção
    ReportErrorToService(error);
}
```

## Use múltiplos blocos `catch` em vez de condicionais `if`

Se você precisa executar uma ação de acordo com o tipo de exceção, use múltiplos blocos `catch`.

**Ruim**

```cs
try
{
    // Faça algo...
}
catch (Exception ex)
{

    if (ex is TaskCanceledException)
    {
        // Faça uma ação para TaskCanceledException
    }
    else if (ex is TaskSchedulerException)
    {
        // Faça uma ação para TaskSchedulerException
    }
}
```

**Bom**

```cs
try
{
    // Faça algo
}
catch (TaskCanceledException ex)
{
    // Faça uma ação para TaskCanceledException
}
catch (TaskSchedulerException ex)
{
    // Faça uma ação para TaskSchedulerException
}
```

## Mantenha a pilha de exceções quando relançar uma exceção

C# permite que uma exceção seja relançada usando a palavra chave `throw`. É uma má prática lançar uma exceção pega usando `throw ex;`, pois isso redefine a pilha de exceções. Em vez disso, use `throw`, dessa forma, mantendo a pilha de exceções. Uma alternativa é lançar uma `throw new CustomException( "alguma informação", ex);` e atribuir `ex` a propriedade `InnerException`. Fazer log de exceções é uma boa prática, porém o objetivo é fazer o log e depois utilizar `throw`.

**Ruim**

```cs
try
{
    FunctionThatMightThrow();
}
catch (Exception ex)
{
    logger.LogInfo(ex);
    throw ex;
}
```

**Bom**

```cs
try
{
    FunctionThatMightThrow();
}
catch (Exception error)
{
    logger.LogInfo(error);
    throw;
}
```

# Comentários

## Evite marcadores de posição

Geralmente apenas adicionam poluição. Deixe com que os nomes de variáveis junto com a indentação e formatação corretas mostrem a estrutura visual do seu código.

**Ruim**

```cs
////////////////////////////////////////////////////////////////////////////////
// Scope Model Instantiation
////////////////////////////////////////////////////////////////////////////////
var model = new[]
{
    menu: 'foo',
    nav: 'bar'
};

////////////////////////////////////////////////////////////////////////////////
// Action setup
////////////////////////////////////////////////////////////////////////////////
void Actions()
{
    // ...
};
```

**Ruim**

```cs
#region Scope Model Instantiation

var model = {
    menu: 'foo',
    nav: 'bar'
};

#endregion

#region Action setup

void Actions() {
    // ...
};

#endregion
```

**Bom**

```cs
var model = new[]
{
    menu: 'foo',
    nav: 'bar'
};

void Actions()
{
    // ...
};
```

## Não deixe código comentado no fonte

Controle de versão existe por um motivo. Deixe código velho no histórico.

**Ruim**

```cs
doStuff();
// doOtherStuff();
// doSomeMoreStuff();
// doSoMuchStuff();
```

**Bom**

```cs
doStuff();
```

## Não faça comentários de histórico

Lembre-se, controle de versão. Não há necessidade para código morto e, especialmente, comentários de histórico. Use o `git log` para isso.

**Ruim**

```cs
/**
 * 2018-12-20: Removido mônadas, pois não entendo (RM)
 * 2017-10-01: Melhorado usando mônadas especiais (JP)
 * 2016-02-03: Removido verificação de tipo (LI)
 * 2015-03-14: Adicionado Combine com verificação de tipo (JR)
 */
public int Combine(int a,int b)
{
    return a + b;
}
```

**Bom**

```cs
public int Combine(int a,int b)
{
    return a + b;
}
```

## Comente coisas que possuem regras de negócio complexas

Comentários são pedidos de desculpas, não um requisito. Um código bom praticamente se auto documenta.

**Ruim**

```cs
public int HashIt(string data)
{
    // hash
    var hash = 0;

    // tamanho da string
    var length = data.length;

    // Loop em cada carctere em data
    for (var i = 0; i < length; i++)
    {
        // Obtém o código do caractere.
        const char = data.charCodeAt(i);
        // Faz o hash
        hash = ((hash << 5) - hash) + char;
        // converter para inteiro de 32 bits
        hash &= hash;
    }
}
```

**Melhor, mas ainda ruim**

```cs
public int HashIt(string data)
{
    var hash = 0;
    var length = data.length;
    for (var i = 0; i < length; i++)
    {
        const char = data.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;

        // Converte para inteiro de 32 bits
        hash &= hash;
    }
}
```

Se o comentário explica O QUÊ o código está fazendo, provavelmente é um comentário desnecessário e pode ser realizado com uma boa nomenclatura de variáveis. Por outro lado, seria difícil expressar porque o desenvolvedor escolheu `djb2` em vez de `sha-1` ou outra função hash. Nesse caso, um comentário é aceitável.

**Bom**

```cs
public int Hash(string data)
{
    var hash = 0;
    var length = data.length;

    for (var i = 0; i < length; i++)
    {
        var character = data[i];
        // Usei hash djb2 porque é um bom compromisso
        // entre velocidade e baixa colisão com implementação simples
        hash = ((hash << 5) - hash) + character;

        hash = ConvertTo32BitInt(hash);
    }
    return hash;
}

private int ConvertTo32BitInt(int value)
{
    return value & value;
}
```

# Desempenho

## Coloque a condição impeditiva antes do trabalho pesado

Se você precisa validar dados, faça isso antes do trabalho pesado evitando, assim, alocação desnecessária de recursos de memória, processador e rede.

**Ruim**

```cs
void UpdatePersonEmail( int id, string emailAddress) {

    Person person = db.Person.find(id);// Desnecessário

    if( !isValidEmailAddress(emailAddress)) {
        throw new Exception("E-mail inválido");
    }

    person.Email = emailAddress;
    db.Person.Update(person);
    db.SaveChanges();
}
```

**Bom**

```cs
void UpdatePersonEmail( int id, string emailAddress) {
    
     if( !isValidEmailAddress(emailAddress)) {
        throw new Exception("E-mail inválido");
    }

    Person person = db.Person.find(id);
    person.Email = emailAddress;
    db.Person.Update(person);
    db.SaveChanges();
}
```

## Coloque as condições mais frequentes primeiro

Ao escrever um bloco `if/else` com múltiplos blocos, coloque as condições mais frequentes primeiro.

**Ruim**

```cs
void CheackAge(int age){

    if( age < 6) {
        throw new InvalidAgeException();
    }
    else if (age >= 13 && age < 18) {
        handleTeenager();
    }
    else if (age >= 6 && age < 13>){
        handleChild();
    }
    else if ( age >= 18) {
        handleAdult();
    }
}
```

**Bom**

```cs
void CheackAge(int age){

    if( age >= 18) {// a maioria dos cientes são adultos
        handleAdults();
    }
    else if (age >= 13) {
        handleTeenager();
    }
    else if (age >= 6){
        handleChild();
    }
    else {
        throw new InvalidAgeException();
    }
}
```

## Evite múltiplas chamadas ao banco de dados

Obter dados de um banco de dados envolve diversas tarefas internas tais como alocar de memória, abrir conexão de rede, converter fluxos de bytes em objetos, etc. Se você tem uma lista de id de objetos que precisa obter do banco para fazer alguma tarefa sobre eles, busque todos em uma chamada e não um por um dentro de um loop. Essa pode ser a diferença entre abrir e fechar 5 mil conexões de rede ou abrir e fechar somente uma conexão.

**Ruim**

```cs
void UpdateTax (int[] employeeList){

    foreach( int id in employeeList)
    {
        //fará uma chamada para cada item na 
        Person person = db.Person.Find(id);lista
        taxService.CalculateTax(person.Salary);
    }
}
```

**Bom**

```cs
void UpdateTax (int[] employeeList){

    //obterá todos os empregados em uma única chamada
    List<Person> personList = db.Person.Where(x=>employeeList.Contains(x.Id)).ToList();

    foreach( Person person in personList)
    {        
        taxService.CalculateTax(person.Salary);
    }
}
```

Internamente, o Entity Framework (ou outro ORM qualquer) irá converter a chamada ao banco nas seguintes instruções SQL:

**Ruim**

```sql
select column1, column2..., columnN from Person p where p.id = @id;
```

**Bom**

```sql
select column1, column2..., columnN from Person p where p.id in ( @idList );
```

# Referências

##### 1. Martin, R. C. (2019). Código Limpo: Habilidades Práticas do Agile Software. Brasil: Alta Books.