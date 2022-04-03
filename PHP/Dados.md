# Boas Práticas e Código Limpo

## Estruturas condicionais e de repetição!
### Pontos importantes:
- Use, sempre que possível, o retorno antecipado da função, de forma que fique mais claro e sem muitos IF, ELSE e ELSE IF espalhados dificultando a leitura e entendimento do código.
- Else são necessário algumas vezes, mas várias vezes podem ser subtituidos por formas mais elegantes de escrita, como o retorno antecipado (Early Return).
- Se vários IFs e ELSEs forem necessários, então pense na possibilidade de utilizar um SWITCH CASE ou abstração para resolver o problema.
- É recomendado evitar estruturas de repetição aninhadas, se possível escreva uma nova função para tratar o retorno da primeira estrutura.  
</br>

## Boas Práticas - PSR's
### As estruturas de repetição e condicionais devem seguir as seguintes boas práticas:
  - Abertura de chaves "{ }" deve ser na mesma linha da declaração da estrutura.
  - Fechamento de chave na linha posterior à ultima linha de código da estrutura.
  - Espaçamentos entre a **(condição da estrutura)** e o nome da estrutura e da chave de abertura.  
</br>
-------------------------
## Exemplos

```PHP
private function randomHit()
{
    $randomizeHit = rand(1, 100);

    //CORRETO - Chaves abertas na mesma linha e com espaçamento dos parênteses.
    if ($randomizeHit <= 50) {
        $this->playerOne->calculateDamage();
    }

    //INCORRETO - Abertura de chaves na linha abaixo e sem espaçamento entre os parênteses.
    if($randomizeHit > 50)
    {
        $this->playerTwo->calculateDamage();
    }
}
```

---------------------------------  
</br>
