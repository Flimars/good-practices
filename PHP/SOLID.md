# Princípios do SOLID

1. **S** ingle Responsability  
2. **O** pen Close  
3. **L** iskov Substituition  
4. **I** nterface segregation  
5. **D** ependency Injection  

-------------------------------

## 1. Single Responsability

Muitas vezes o princípio da Responsabilidade Única é falada em relação à funções, porém ela é muito mais abrangente que isso e pode ser aplicada aos três itens abaixo.

### Variáveis

- Deve contar apenas com uma responsabilidade;
- Não se cria uma variável genérica como $objeto e instancia classes diferentes nela no mesmo trecho de código.

### Funções

- Devem fazer apenas uma ação por chamada do método;
- Se necessário, uma função pode acionar outra função, para que uma complemente as ações da outra;
- Uma função jamais deve permitir alterar o tipo de seu retorno com base em um parâmetro, isso lhe indica que está com mais de uma responsabilidade.

### Classes

- Não deve fazer mais do que seu escopo lhe permite;
- Classes devem possuir apenas um motivo para serem alteradas;
- Gerar inúmeros arquivos com classes que sigam o SRP exige cuidado com a organização do projeto.
- Se uma classe é Controladora, ela tem a responsabilidade de tratar requisições e respostas, porém jamais conter regras de negócio, função essa destinada à classes como a Service, por exemplo.
- Classes Active Record jamais devem possuir implementações de métodos publicos, qualquer acesso à classe deve ser feita por meio de Repositories.

-------------------------------

## 2. Open Close

Princípio do Aberto e Fechado é atribuido à contextos maiores, como classes.  
Este princípio visa garantir que uma classe jamais tenha motivos para ser alterada, apenas estendida.  
Para garantir a aplicação do Aberto/Fechado é necessário a implementação de classes base, que serão estendidas para classes especialistas, dessa forma, sempre que algo novo deve ser implementado é importante que uma nova classe especialista seja criada com o intuito de implementar as novas funcionalidades.  
Dessa forma as classes especialistas podem receber novas funções e sobrecarga ou sobreposição de funções da classe pai sem alterá-la.  

-------------------------------

## 3. Liskov Substituition

Princípio da Substituição de Liskov.
Uma definição muito prática deste princípio é:

> "*Uma classe base pode ser substituída por sua classe derivada.*"

Pensando nisso devemos sempre pensar se a decisão de aplicar a herança foi realmente interessante naquele contexto.

> "Se nada como um pato, grasna como um pato, anda como um pato, mas precisa de baterias? Então não é um pato."

A ideia é que por mais parecido que seja um objeto do outro, não significa deva ser aplicado o conceito de Herança, pois haverá muitas modificações em seu comportamento, como a dependência de "gastar baterias" ao realizar suas ações, como andar ou grasnar.  
No exemplo acima, as Classes Pato e PatoEletrico não poderiam ser substituídas uma pela outra sem que o funcionamento da aplicação seja prejudicado.  
Para não quebrar o princípio da substituição de Liskov é importante repensar a forma como se aplica Herança.  

-------------------------------

## 4. Interface segregation

Princípio da Segregação de Interfaces.
O objetivo deste princípio é garantir que nenhuma classe que possua um contrato seja obrigada à implementar um método que não precisa.  
Se mais de uma classe utiliza a mesma interface, porém uma possui uma função à mais que a outra, o correto seria a implementação de interfaces separadas para cada uma.  
Jamais utilize uma interface se isso te obrigar à implementar uma função que não é necessária.  

-------------------------------

## 5. Dependency Injection

Princípio da Inversão de Dependências.  
A injeção de dependências é algo comum na orientação à objetos, com uso de Classes Abstratas ou Interfaces.  
O último princípio do SOLID prevê justamente o uso adequado de interfaces, garantindo que uma classe jamais dependa diretamente de outra e sim de sua interface.  
Dessa forma ao injetar uma dependência, é injetada a sua interface ao invés da classe em si, garantindo que caso qualquer novo método seja implementado ou caso a classe seja refatorada, nada afete seu comportamento.  
Um contexto interessante para pensar sobre a Inversão de Dependência é:

> "*Voce usa óculos e precisa trocar o seu óculos por um novo, esse princípio garante que o novo óculos possua as mesmas características básicas que o antigo, para que ele encaixe perfeitamente no seu rosto e nariz, mesmo que seja de lentes escuras ou com grau maior, sem que seja necessário você mandar o óculos para realizar ajustes nas hastes ou nas plaquetas depois que já o trocou pelo antigo.*"

-------------------------------

[Início](PHP.md)
