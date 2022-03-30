# Boas Práticas e Código Limpo

## Variáveis!
### Pontos importantes:
- Variáveis são essencialmente a representação de algo muito específico, portanto devem possuir nomes muito específicos também.
- O tamanho do nome de uma variável deve ser proporcional ao seu escopo.
- Três variáveis diferentes podem armazenar instâncias diferentes de uma mesma classe, jamais nomeie-as como $objeto1, $objeto2 e $objeto3.
- Variáveis também devem seguir o Princípio da Responsabilidade Única, não devendo ser alterada de tipo ou objetivo durante o código, $contaCorrente, sempre será $contaCorrente.
- A definição de **camelCase** para nomear variáveis é um consensso, porém não está documentada em nenhuma PSR.  
</br>

```PHP
class AccountManagement implements AccountInterface
{
    //Não é recomendado utilizar números para variáveis que instanciam o mesmo objeto.
    //ERRADO
    private $conta1;
    private $conta2;
    private $conta3;

    //Dessa forma fica mais claro, você saberá exatamente qual conta é o que no futuro do código e o próximo desenvolvedor entenderá muito melhor as variáveis e para que elas servem.
    //CORRETO
    private $contaCorrentePessoaFisica;
    private $contaCorrentePessoaJuridica;
    private $contaPoupança;
    private $contaInvestimento;

    public function findAccount()
    {
       $this->contaCorrentePessoaFisica = (new ContaCorrente())->find($idPessoaFisica);
       $this->contaCorrentePessoaJuridica = (new ContaCorrente())->find($idPessoaJuridica);
    }
}
```
- Variáveis de instância, ou globais, devem ser **sempre** **claras** e **objetivas**, porém cuide do tamanho do seu escopo para que essa variável não se perca no objetivo quando utilizada em muitas funções.
- Uma variável `$name` pode ser o nome de qualquer coisa, nesse caso está ligada à classe, portanto é o nome do Jogador. Por isso a definição clara de **à quem** estamos nos referindo com o `$name` é essencial.
- Não há necessidade de prefixar as variáveis com o nome da *Classe*, **principalmente** com abreviações, é redundância.
- **Jamais** use variáveis que não é possível pronunciar, cheia de abreviações e letras que parecem aleatórias.  
</br>

```PHP
class Player
{
    //CORRETO
    private $name;           //Nome do Jogador, porque a classe se refere à ele.
    private $charactersName; //Nome do Personagem escolhido pelo jogador, explícito.
    private $initialLife;
    private $actualLife;
    private $powers;
    private $description;
    private $id;
    private $victories;

    //Aqui vemos o uso do nome da classe como prefixo para as variáveis e casos extremos uma abreviação do nome nos dois últimos exemplos.
    //ERRADO
    private $playerName;
    private $playerCharactersName;
    private $playerInitialLife;
    private $plPowers;
    private $plDescription;

    //Aqui o exemplo de variáveis com abreviações e letras que parecem aleatórias.
    //MUITO ERRADO
    private $nmPlayer;
    //"Fulano, a variavel 'ene eme cê aga' ta vindo nula..." - Fica bem estranho essa conversa né?
    private $nmCh;
    //Tente falar o nome dessa variável. Conseguiu? Acredito que não!
    private $plIniLf;
    private $descr;

    public function __construct()
    {
        //... Código
    }
}

class Fight
{
    private function getPlayersName()
    {
        //Ao instanciar a classe,
        //É facil saber que se trata do nome do Player na hora de utilizar o objeto.
        $playerNumberOne = (new Player());
        $playerNumberOne->name;
    }
}
```
- No exemplo acima, o mais correto seria um objeto Character como um dos atributos de Player, onde haveria seu nome e demais atributos.

---------------------------------  
</br>

## Fontes:
- https://www.php-fig.org/psr/