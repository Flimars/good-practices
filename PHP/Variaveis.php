<?php

//Variáveis são essencialmente a representação de algo muito específico, portanto devem possuir nomes muito específicos também.

//Três variáveis diferentes podem armazenar instâncias diferentes de um mesmo objeto.

//O tamanho do nome de uma variável é proporcional ao seu escopo.

//Se a sua equipe definiu uma regra para nomes de variáveis, desde que sigam basicamente esses critérios acima, então siga-o,
//CLEAN CODE não é um padrão gravado em pedra, são conceitos para manter uma melhor legibilidade do código.

/* Exemplos */

/**
 * Objeto Player representa um personagem escolhido pelo jogador para um combate.
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
            'name' => $this->charactersName,
            'initialLife' => $this->initialLife,
            'actualLife' => $this->actualLife,
            'description' => $this->description,
            'powers' => $this->powers,
        ];

        return $attributes;
    }

    public function calculateDamage($hit)
    {
        $this->actualLife -= $hit;
    }
}

class Fight
{
    //Não é ideal utilizar números para variáveis que instanciam o mesmo objeto, até por entendimento aqui seria melhor usar um nome diferente.
    //ERRADO
    private $player1;
    private $player2;

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
        $round = 0;

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


?>