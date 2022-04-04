# Boas Práticas e Código Limpo

## Funções

1. Funções representam as ações que uma Classe pode executar e elas devem exclusivamente possuir apenas uma ação. Esse é o Principio mais conhecido do SOLID, o da **Single Responsability**. Vide [SOLID](SOLID.md).
2. Por questões de cobertura de testes e facilidade de entendimento, é **recomendado** que cada função não contenha muitos parâmetros de entrada, preferencialmente nenhum.
3. **A quantidade de parâmetros** de uma função pode ser a **evidência** de que esta função está tendo mais do que apenas uma responsabilidade, sempre se pergunte isso ao escrever uma função.
4. Uma função deve possuir um nome que descreva exatamente o que ela faz, **se o nome está muito extenso ou dificil** de escolher um, repense se ela está executando apenas uma responsabilidade.
5. A função pode, mesmo possuindo uma única responsabilidade, chamar outra função para complementar o seu objetivo, desde que a outra função também possua apenas uma responsabilidade.
6. Nomes extensos não são sinal de código feio e sim de código claro, mas atente-se para não escrever um nome que ultrapasse a indicação de 120 caracteres por linha durante as chamadas dela, tenha **bom senso**.
7. Comentários que expliquem o que sua função faz são um sinal de que o nome não está explícito ou que ela está ferindo o princípio da responsabilidade única. Vide [Comentários](Comentarios.md).
8. Sempre possuir sua visibilidade explícita na declaração da função: **private, public, etc.**.
9. Abertura de chaves **"{ }"** deve sempre iniciar na linha abaixo da declaração da função e encerrar na linha abaixo da ultima linha de código.
10. Utilizar o padrão **camelCase** para escrever seu nome.
11. Parênteses, com ou sem parâmetros, não devem possuir nenhum espaçamento do nome da função.

## Outras recomendações

1. Trechos de código que possuem o mesmo assunto devem permanecer juntos, porém ao iniciar um novo assunto pode-se aplicar uma linha vazia entre as linhas de código.
2. As funçoes devem ser escritas na ordem em que são executadas, de forma que um novo desenvolvedor entenda que cada função está posicionada abaixo da função que à chamou.
3. Casos onde uma função é chamada diversas vezes, como um helper ou algo assim, pode-se deixá-la no final do aquivo, após todas as demais funções sequenciais.

-------------------------

## Exemplos

Ruim

```PHP
//Abertura de chaves na mesma linha da declaração da função.
//O próprio nome já declara que está fazendo duas coisas na mesma função
private function loadCharacterAtributesAndDefineInitialLife() {
    $character = $this->getCharacterOnDatabase();

    $this->charactersName = $character->name;
    $this->powers = $character->powers;
    $this->description = $character->description;

    //O correto seria extrair esse IF para uma nova função que somente faça o cálculo desse atributo.
    if ($character->lifePercentAddition > 0) {
        // ... código para calcular o Life inicial do personagem.
        $this->initialLife = $calculationResult;
    }
}

//Função com muitos parâmetros e sem a devida aplicação de boas práticas para descrever os parâmetros.
private function randomHit($playerOneLife, $playerTwoLife, $hitPower, $hitAdditionalByCombo)
{
    //... código utilizando todos esses parâmetros
}

```

Bom

```PHP
//Abertura correta de chaves após declaração e na linha posterior ao fim do código;
private function loadCharacterAtributes()
{
    $character = $this->getCharacterOnDatabase();

    $this->charactersName = $character->name;
    $this->powers = $character->powers;
    $this->description = $character->description;

    $this->initialLife = $this->calculateInitialLife();
}

//Trecho extraído da função acima virou essa função com uma única responsabilidade.
private function calculateInitialLife($character)
{
    if ($character->lifeAddition > 0) {
        // ...código para calcular o Life inicial do personagem.
        return $calculationResult;
    }

    return $this->initialLife;
}

//Função com poucos ou sem parâmetros, tudo trabalhando com os métodos e atributos do objeto instanciado.
private function randomHit()
{
    $randomizeHit = rand(1, 100);

    if ($randomizeHit <= 50) {
        $this->playerOne->calculateDamage();
    }

    if($randomizeHit > 50) {
        $this->playerTwo->calculateDamage();
    }
}
```
