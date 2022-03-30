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
