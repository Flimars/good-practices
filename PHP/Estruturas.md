# Boas Práticas e Código Limpo

## Estruturas condicionais e de repetição

Algumas das boas práticas aqui apresentadas foram retiradas das PSRs do _PHP-FIG_ e outras do artigo sobre _Object Calisthenics_, referenciados [aqui](php.md).

1. Use, sempre que possível, o retorno antecipado da função (early return). Dessa forma seguimos a regra de **"Don't use the ELSE keyword"** do artigo sobre calistenia. O ELSE pode causar muitas confusões em um código, evitar o uso dele aplicando Early Return, por exemplo, garante um código mais claro para o leitor.

Ruim

```PHP
private function randomHit()
{
    $randomizeHit = rand(1, 100);

    if ($randomizeHit <= 50) {
        $variavel = $this->playerOne->calculateDamage();
    } else {
        $variavel = $this->playerTwo->calculateDamage();
    }

    return $variavel;
}
```

Bom

```PHP
private function randomHit()
{
    $randomizeHit = rand(1, 100);

    if ($randomizeHit <= 50) {
        return $this->playerOne->calculateDamage(); // <- Early Return
    }

    return $this->playerTwo->calculateDamage(); // Return que seria feito no ELSE.
}
```

2. Evite estruturas aninhadas, é recomendado manter apenas um nível de identação por função. É possível aplicar essa regra, também da Calistenia de Objetos, usando o Method Extract, extraindo aquele trecho de código que gerou a próxima identação e transformando-o em uma função.

Ruim

```PHP
public function roundFight()
{
    $playersAlive = true;

    while ($playersAlive) { // <- Um nível de identação.
        $this->randomHit();

        if ($playerOne->actualLife =< 0 || $playerTwo->actualLife =< 0) {  // <- Dois níveis de identação.
            $playersAlive = false;
        }
    }
}
```

Bom

```PHP
public function roundFight()
{
    $playersAlive = true;

    while ($playersAlive) { // <- Um nível de identação.
        $this->randomHit();

        $playersAlive = $this->playersStillAlive(); // <- Method Extract
    }
}

//Novo método criado
public function playersStillAlive()
{
    if ($playerOne->actualLife =< 0 || $playerTwo->actualLife =< 0) {
        return false;
    }

    return true;
}
```

3. Abertura de chaves "{ }" deve ser na mesma linha da declaração da estrutura.
4. Fechamento de chave na linha posterior à ultima linha de código da estrutura.
5. Espaçamentos entre a **(condição da estrutura)** e o nome da estrutura e da chave de abertura.

Ruim

```PHP
private function ifFunctionJustForExample()
{
    //Abertura de chaves na linha abaixo da condição.
    //Sem espaçamento entre os parênteses e a keyword.
    while($playersAlive)
    {
        $this->randomHit();
        $playersAlive = $this->playersStillAlive();
    }

    //Jamais utilize uma estrutura linear dessa forma, se possível utilize Operador Ternário.
    if($randomizeHit > 50) { $this->playerTwo->calculateDamage(); }

    //Não possui chaves para determinar o trecho de código.
    //Padrão não recomendado, mesmo que haja apenas uma linha de código no IF.
    if($randomizeHit > 50)
        $this->playerTwo->calculateDamage();
}
```

Bom

```PHP
private function ifFunctionJustForExample()
{
    //Chaves abertas na mesma linha
    //Com espaçamento dos parênteses entre a keyword e a chave de abertura.
    //Fechamento de chaves na linha posterior ao trecho de código.
    if ($randomizeHit <= 50) {
        $this->playerOne->calculateDamage();
    }

    while ($playersAlive) {
        $this->randomHit();
        $playersAlive = $this->playersStillAlive();
    }
}
```

---------------------------------  
</br>
