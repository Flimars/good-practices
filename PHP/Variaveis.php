<?php

//Variáveis são essencialmente a representação de algo muito específico, portanto devem possuir nomes muito específicos também.
//O tamanho do nome de uma variável é proporcional ao seu escopo.
//Três variáveis diferentes podem armazenar instâncias diferentes de uma mesma classe, jamais nomeie-as como $objeto1, $objeto2 e $objeto3.

//Funções representam as ações do sistema e elas devem exclusivamente executar uma só ação.
//Esse é o Principio mais conhecido do SOLID, mesmo que nem saiba o que é SOLID ainda, o da Sigle Responsability (Responsabilidade Única)

//Classes são as representações de objetos, assuntos ou entidades e que agrupam diversas funções e atributos.
//Uma classe de entidade, de banco de dados, conhecida como Model, é nada mais e nada menos que para entrada e saída de dados do banco, não deve haver regras de negócios, porém pode possuir funções de Active Record.
//Uma classe de objeto, que representa algo concreto, que deverá ser instanciado em uma variável para ser trabalhada deve possuir apenas seus atributos básicos e funções de ação do objeto.
//Uma classe de assunto, que agrupa funções que irão atuar com a Model e os Objetos para que as regras de negócio sejam executadas, tratadas e direcionadas para onde devem ir.
//Uma classe abstrata geralmente representa as funções comuns de algo que poderá ser utilizada em outras classes, como por exemplo o 

//Se a sua equipe definiu uma regra para nomes de variáveis, funções e classes, desde que sigam basicamente esses critérios acima, então siga-o,
//CLEAN CODE não é um padrão gravado em pedra, são conceitos para manter uma melhor legibilidade do código.
//Li outro dia isso e achei muito interessante: Clean Code está mais para Código Claro do que para Código Limpo, não é sobre reduzir linhas ou apagar IFs.

/* Exemplos */

/**
 * A classe Fight representa o assunto Luta e ela agrupa todas as funções e regras relacionadas à luta em si.
 */
class Fight
{
    //Não é recomendado utilizar números para variáveis que instanciam o mesmo objeto, até por entendimento, aqui seria melhor usar um nome diferente.
    //ERRADO
    private $player1;
    private $player2;
    //Pense em variáveis de um programa de banco e o cliente tem mais de uma conta, ele vai instanciar a $conta1, $conta2, $conta3, nem você saberá o que é o que no futuro.

    //Assim define mais que é o jogador número 1 do que $player1, poderia até ser $playerNumberOne e $playerNumberTwo
    //CORRETO
    private $playerOne;
    private $playerTwo;

    public function defineCharactersPlayers()
    {
        $idPlayerOne = rand(1, 100);
        $idPlayerTwo = rand(1, 100);

        $this->playerOne = (new Player($idPlayerOne));
        $this->playerTwo = (new Player($idPlayerTwo));
    }

    public function roundFight()
    {
        $playersAlive = true;

        while ($playersAlive) {
            $this->randomHit();

            if (!$this->playersStillAlive()) {
                $playersAlive = false;
            }
        }
    }

    private function randomHit()
    {
        $randomizeHit = rand(1, 100);

        if ($randomizeHit <= 50) {
            $this->playerOne->calculateDamage();
        }

        if ($randomizeHit > 50) {
            $this->playerTwo->calculateDamage();
        }
    }

    private function playersStillAlive()
    {
        if ($this->playerOne->actualLife <= 0) {
            $this->playerTwo->victories += 1;
            return false;
        }

        if ($this->playerTwo->actualLife <= 0) {
            $this->playerOne->victories += 1;
            return false;
        }

        return true;
    }

}

/**
 * A classe Player representa o Objeto Player que é o personagem escolhido pelo jogador para um combate.
 */
class Player
{
    //Variáveis globais devem ser sempre claras e objetivas, porém cuide do tamanho do seu escopo.
    //Um $name pode ser o nome de qualquer coisa, nesse caso pode ser o nome do Jogador ou do seu Personagem.
    //Por isso a definição clara de à quem estamos nos referindo com o $name.

    //CORRETO
    private $playersName;
    private $charactersName;
    private $initialLife;
    private $actualLife;
    private $powers;
    private $description;
    private $id;
    private $victories;

    //Não há necessidade de prefixar as variáveis com o nome da Classe, principalmente com abreviações, é redundância.
    //ERRADO
    private $playerName;
    private $playInitialLife;
    private $plPowers;
    private $pDescription;

    //Jamais use variáveis que não é possível pronunciar, cheia de abreviações e letras que parecem aleatórias.
    //MUITO ERRADO
    private $nmPlayer;
    private $nmCh; //Fulano, a variavel 'ene eme cê aga' ta vindo nula... Fica bem estranho essa conversa né?
    private $plIniLf; //Tente falar isso, como se estivesse conversando com alguém. Conseguiu? Acredito que não!
    private $descr;

    public function __construct($id)
    {
        $this->id = $id;
        $this->loadAtributesById();
        $this->actualLife = $this->initialLife;
    }

    private function loadAtributesById()
    {
        $character = $this->getCharacterOnDatabase();

        $this->charactersName = $character->name;
        $this->initialLife = $character->initialLife;
        $this->powers = $character->powers;
        $this->description = $character->description;
    }

    private function getCharacterOnDatabase()
    {
        return (new CharacterModel)->where('id', $this->id);
    }

    public function getPowers()
    {
        //Fica claro que está listando os poderes do personagen instanciado.
        return $this->powers;
    }

    public function getAllAttributes()
    {
        //Lista todos os atributos do personagem.
        $attributes = [
            'playersName' => $this->playersName,
            'charactersName' => $this->charactersName,
            'initialLife' => $this->initialLife,
            'actualLife' => $this->actualLife,
            'description' => $this->description,
            'powers' => $this->powers,
            'victories' => $this->victories,
        ];

        return $attributes;
    }

    public function calculateDamage($hit)
    {
        $this->actualLife -= $hit;
    }
}

/**
 * A classe CharacterModel representa o banco de dados e todas as suas funções relacionadas à banco de dados
 * Aqui não cabe regras de negócios, apenas e exclusivamente entradas e saídas de banco de dados.
 */
class CharacterModel
{
    //Código de consulta ao banco de dados aqui.
}


?>