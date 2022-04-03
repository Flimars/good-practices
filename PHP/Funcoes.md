# Boas Práticas e Código Limpo

## Funções!
### Pontos importantes:
- Funções representam as ações que uma Classe pode executar e elas devem exclusivamente possuir apenas uma ação.
- Esse é o Principio mais conhecido do SOLID, o da **Single Responsability**. Vide [SOLID](SOLID.md).
- Por questões de cobertura de testes, é *recomendado* que cada função *não contenha muitos parâmetros* de entrada, *preferencialmente nenhum*, dessa forma os testes se tornam mais precisos.
- *A quantidade de parâmetros* de uma função pode ser a *evidência* de que esta função está tendo mais do que apenas uma responsabilidade, *sempre se pergunte isso ao escrever uma função*.
- Uma função deve possuir um nome que descreva exatamente o que ela faz, *se o nome está muito extenso ou dificil* de escolher um, *repense se ela está executando apenas uma responsabilidade*.
- A função pode, mesmo possuindo uma única responsabilidade, chamar outra função para complementar o seu objetivo, desde que a outra função também possua apenas essa responsabilidade.
- Nomes extensos não são sinal de código feio e sim de código com clareza, mas atente-se para não escrever um nome que ultrapasse a indicação de 120 colunas por linha durante as chamadas dela, tenha **bom senso**.
- Comentários que expliquem o que sua função faz são um sinal de que o nome não está explicito ou que ela esta ferindo o principio da responsabilidade única. Vide [Comentários](Comentarios.md).  
</br>

## Outras recomendações!
- Trechos de código que possuem o mesmo assunto devem permanecer juntos, porém ao iniciar um novo assunto pode-se aplicar uma linha vazia entre as linhas de código.
- As funçoes devem ser escritas na ordem em que são executadas, de forma que um novo desenvolvedor entenda que cada função está posicionada abaixo da função que à chamou.
- Casos onde uma função é chamada diversas vezes, como um helper ou algo assim, pode-se deixá-la no final do aquivo, após todas as demais funções sequenciais.

## Boas Práticas - PSR's
### As funções devem seguir as seguintes boas práticas:
  - Sempre possuir sua visibilidade explícita na declaração da função: **private, public, etc.**.
  - Abertura de chaves **"{ }"** deve sempre iniciar na linha abaixo da declaração da função e encerrar na linha abaixo da ultima linha de código.
  - Utilizar o padrão **camelCase** para escrever seu nome.
  - Parênteses, com ou sem parâmetros, não devem possuir nenhum espaçamento do nome da função.  
<br/>
-------------------------
## Exemplos

```PHP

public function __construct($id)
{
    $this->id = $id;
    $this->loadAtributesById();
    $this->actualLife = $this->initialLife;
}

//INCORRETO
//Abertura de chaves na mesma linha da declaração da função.
private function loadAtributesById() {
    //CORRETO
    //Função com apenas uma responsabilidade, de carregar os atributos do Objeto.
    //Aciona outro método que também possui apenas uma responsabilidade para concluir sua função.
    $character = $this->getCharacterOnDatabase();

    $this->charactersName = $character->name;
    $this->initialLife = $character->initialLife;
    $this->powers = $character->powers;
    $this->description = $character->description;
}

//CORRETO
//Abertura de chaves na linha abaixo da declaração e nomeada em camelCase.
//Descrita logo abaixo na ordem de execução e nome da função bem descrito.
private function getCharacterOnDatabase()
{
    //... código
}

//CORRETO
//Funções com poucos ou sem parâmetros, tudo trabalhando com os métodos e atributos do objeto instanciado.
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

---------------------------------  
</br>
