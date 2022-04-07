# Boas Práticas e Código Limpo

## Variáveis

1. Variáveis são essencialmente a representação de algo muito específico, portanto devem possuir nomes muito específicos também.
2. O tamanho do nome de uma variável deve ser proporcional ao seu escopo.
3. Três variáveis diferentes podem armazenar instâncias diferentes de uma mesma classe, evite nomea-las como $objeto1, $objeto2 e $objeto3.
4. Variáveis também devem seguir o Princípio da Responsabilidade Única, não devendo ser alterada de tipo ou objetivo durante o código, $contaCorrente, sempre será $contaCorrente e uma string sempre deve ser uma string.
5. A definição de **camelCase** para nomear variáveis é um consenso, porém não está documentada em nenhuma PSR.
6. Evite o uso de Notação Húngara para nomear variáveis. _- Uso de prefixo abreviado com o tipo da variável_.

Ruim

```PHP
class AccountManagement implements AccountInterface
{
    //Não é recomendado utilizar números para variáveis que instanciam o mesmo objeto.
    private $conta1;
    private $conta2;
    private $conta3;
    private $strClientName; // <- Notação húngara não deve ser usada.
}
```

Bom

```PHP
class AccountManagement implements AccountInterface
{
    //Dessa forma fica mais claro, você saberá exatamente qual conta é o que no futuro do código
    //O próximo desenvolvedor entenderá muito melhor as variáveis e para que elas servem.

    private $contaCorrentePessoaFisica;     //<- Nome grande, explicativo.
    //ou
    private $contaCorrenteCPF; // <-Identificando que é de CPF, pessoa física.
    private $contaCorrenteCNPJ; // <-Identificando que é do CNPJ, empresa.

    private $contaPoupança;
    private $contaInvestimento;

    public function findAccountsByClientId()
    {
       $this->contaCorrenteCPF = (new ContaCorrente())->find($idPessoaFisica);
       $this->contaCorrenteCNPJ = (new ContaCorrente())->find($idPessoaJuridica);
    }
}
```

1. Variáveis de instância, ou globais, devem ser **sempre claras e objetivas**, porém cuide do tamanho do seu escopo para que essa variável não se perca no objetivo quando utilizada em muitas funções.
2. Uma variável `$name` pode ser o nome de qualquer coisa, no caso abaixo está ligada à classe, portanto é o nome do Jogador. Por isso a definição clara de **à quem** estamos nos referindo com o `$name` é essencial.
3. Não há necessidade de prefixar as variáveis com o nome da _Classe_, **principalmente** com abreviações, é **redundância**.
4. **Jamais** use variáveis que não é possível pronunciar, cheia de abreviações e letras que parecem aleatórias.

**MUITO** Ruim

```PHP
class Player
{
    private $nmPlayer;

    //"Fulano, a variavel 'ene eme cê aga' ta vindo nula..." - Fica bem estranho essa conversa né?
    private $nmCh;

    //Tente falar o nome dessa variável. Conseguiu? Acredito que não!
    private $plIniLf;
}
```

Ruim

```PHP
class Player
{
    //Aqui vemos o uso do nome da classe como prefixo para as variáveis
    private $playerName;
    private $playerCharactersName;
    private $playerInitialLife;
     //Em casos extremos uma abreviação do nome nos dois últimos exemplos.
    private $plPowers;
    private $plDescription;
    //Ou apenas uma variável abreviada sem motivo algum.
    private $descr;
}
```

Bom

```PHP
class Player
{
    private $id;
    private $name;                // <- Nome do Jogador, porque a classe se refere à ele.
    private $charactersName;      // <- Nome do Personagem escolhido pelo jogador.
    private $initialLife;         // <- Variáveis com nomes bem explicativos;
    private $actualLife;
    private $powers;
    private $description;
    private $victories;
}

class Fight
{
    private function getPlayersName()
    {
        $playerNumberOne = (new Player());
        $playerNumberOne->name;          // <- É facil identificar quando se trata do nome do Player.
        $playerNumberOne->characterName; // <- Ou do nome do personagem do Player.
    }
}
```

[Início](PHP.md)
